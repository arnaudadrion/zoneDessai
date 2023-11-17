<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\MultipleChoiceQuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MultipleChoiceQuestionRepository::class)
 */
class MultipleChoiceQuestion extends AbstractQuestion
{
    /**
     * @var Choice[]
     * @ORM\OneToMany(targetEntity=Choice::class, mappedBy="question", cascade={"persist"})
     */
    private $choices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
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
            $choice->setQuestion($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): self
    {
        if ($this->choices->contains($choice)) {
            $this->choices->removeElement($choice);
            // set the owning side to null (unless already changed)
            if ($choice->getQuestion() === $this) {
                $choice->setQuestion(null);
            }
        }

        return $this;
    }

    public function getMaximumScore()
    {
        $maximumScore = 0;
        foreach ($this->choices as $choice) {
            $maximumScore += $choice->getValue();
        }

        return $maximumScore;
    }
}
