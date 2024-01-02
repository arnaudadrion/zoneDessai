<?php

namespace App\Entity\Survey;

use App\Repository\Survey\SurveyResultRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[ORM\Entity(repositoryClass: SurveyResultRepository::class)]
class SurveyResult
{
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column]
    private float $score;

    #[ORM\Column]
    private float $trustScore;

    #[ORM\ManyToOne(targetEntity: Survey::class)]
    private ?int $survey;

    public function getId()
    {
        return $this->id;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function setScore($score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getTrustScore(): float
    {
        return $this->trustScore;
    }

    public function setTrustScore($trustScore): self
    {
        $this->trustScore = $trustScore;

        return $this;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey($survey): self
    {
        $this->survey = $survey;

        return $this;
    }
}
