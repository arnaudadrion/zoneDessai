<?php

namespace App\Entity\Survey;

use App\Entity\Survey\Question\AbstractQuestion;
use App\Repository\Survey\SurveyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

/**
 * @ORM\Entity(repositoryClass=SurveyRepository::class)
 */
class Survey
{
    use SoftDeleteableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=AbstractQuestion::class, mappedBy="survey", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $questions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transchain;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return $this
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|AbstractQuestion[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(AbstractQuestion $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setSurvey($this);
        }

        return $this;
    }

    public function removeQuestion(AbstractQuestion $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getSurvey() === $this) {
                $question->setSurvey(null);
            }
        }

        return $this;
    }

    public function getMaximumScore(): int
    {
        $maximumScore = 0;
        foreach($this->questions as $question) {
            $maximumScore += $question->getMaximumScore();
        }

        return $maximumScore;
    }

    /**
     * Set transchain
     *
     * @param string $transchain
     *
     * @return Survey
     */
    public function setTranschain($transchain)
    {
        $this->transchain = $transchain;

        return $this;
    }

    /**
     * Get transchain
     *
     * @return string
     */
    public function getTranschain()
    {
        return $this->transchain;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
