<?php

namespace App\Entity\Survey\Answer;

use App\Entity\Survey\Question\AbstractQuestion;
use App\Entity\Survey\Question\Choice;
use App\Entity\User;
use App\Repository\Survey\Answer\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
#[Gedmo\SoftDeleteable(fieldName: 'deletedAt', timeAware: false, hardDelete: true)]
class Answer
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\ManyToOne(targetEntity: AbstractQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    protected AbstractQuestion $question;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "answers")]
    protected User $user;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 255, nullable: true)]
    private string $value;

    #[ORM\ManyToMany(targetEntity: Choice::class)]
    #[ORM\JoinTable(name: "answer_choice")]
    #[JoinColumn(name: "id_answer", referencedColumnName: "id")]
    #[InverseJoinColumn(name: "id_choice", referencedColumnName: "id")]
    private Collection $choices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value)
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

    public function setUser(User $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }
}
