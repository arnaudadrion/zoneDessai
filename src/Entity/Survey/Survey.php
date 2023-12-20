<?php

namespace App\Entity\Survey;

use App\Entity\Survey\Question\AbstractQuestion;
use App\Repository\Survey\SurveyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;


#[ORM\Entity(repositoryClass: SurveyRepository::class)]
class Survey
{
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 255, unique: true)]
    private string $name;

    #[Gedmo\Slug(fields: ['name'])]
    #[ORM\Column(length: 255, unique: true)]
    private string $slug;

    #[ORM\OneToMany(mappedBy: 'survey', targetEntity: AbstractQuestion::class)]
    private $questions;

    #[ORM\Column(length: 255, unique: true)]
    private string $transchain;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }


    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug() : ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug) : self
    {
        $this->slug = $slug;

        return $this;
    }

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

    public function setTranschain($transchain): self
    {
        $this->transchain = $transchain;

        return $this;
    }

    public function getTranschain(): string
    {
        return $this->transchain;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
