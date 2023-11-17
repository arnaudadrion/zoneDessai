<?php

namespace App\Entity\Survey\Answer;

use App\Entity\Project\Project;
use App\Entity\Survey\Question\AbstractQuestion;
use App\Entity\Survey\Question\Choice;
use App\Repository\Survey\Answer\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Table(name="answer")
 * @ORM\Entity(repositoryClass=AnswerRepository::class)
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 */
class Answer
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * @var AbstractQuestion
     * @ORM\ManyToOne(targetEntity=AbstractQuestion::class)
     * @ORM\JoinColumn(nullable=false)
     */
    protected $question;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="answers")
     */
    protected $project;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @var Choice[]
     * @ORM\ManyToMany(targetEntity=Choice::class)
     * @ORM\JoinTable(name="answer_choice",
     *      joinColumns={@ORM\JoinColumn(name="id_answer", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_choice", referencedColumnName="id")}
     * )
     */
    private $choices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return Collection|Choice[]
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): self
    {
        if (!$this->choices->contains($choice)) {
            $this->choices[] = $choice;
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->choices->contains($choice)) {
            $this->choices->removeElement($choice);
        }

        return $this;
    }

    public function getQuestion(): AbstractQuestion
    {
        return $this->question;
    }

    /**
     * @param AbstractQuestion|null $question
     */
    public function setQuestion(AbstractQuestion $question): Answer
    {
        $this->question = $question;

        return $this;
    }

    public function getScore()
    {
        $score = null;
        if (!$this->choices->isEmpty()) {
            // MULTIPLE CHOICE QUESTION => SUM CHOICES
            // SINGLE CHOICE QUESTION => VALUE * WEIGHT
            $score = 0;
            foreach ($this->choices as $choice) {
                $score += ((float)$choice->getValue() * $choice->getWeight());
            }
        }

        return $score;
    }

    public function __toString()
    {
        $result = '';
        if (!$this->choices->isEmpty()) {
            foreach ($this->choices as $choice) {
                if ('' !== $result) {
                    $result .= ', ';
                }
                $result .= $choice->getLabel();
            }
        } else {
            $result = (string)$this->value;
        }

        return $result;
    }

    /**
     * Set project
     *
     * @param \App\Entity\Project\Project $project
     *
     * @return Answer
     */
    public function setProject(\App\Entity\Project\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \App\Entity\Project\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
