<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\ChoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: ChoiceRepository::class)]
#[ORM\Table(name: "question_choice")]
class Choice
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: "text")]
    private string $label;

    #[ORM\Column(type: "text")]
    private string $value;

    #[ORM\Column(type: "float")]
    private $weight;

    #[ORM\ManyToOne(targetEntity: AbstractQuestion::class, cascade: ["persist"], inversedBy: "choices")]
    private $question;

    #[ORM\Column(length: 255, nullable: true)]
    private $transchain;

    /**
     * @return ?int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight)
    {
        $this->weight = $weight;
    }

    public function getQuestion(): AbstractQuestion
    {
        return $this->question;
    }

    public function setQuestion(AbstractQuestion $question)
    {
        $this->question = $question;
    }

    public function __toString(): string
    {
        return $this->getLabel();
    }

    public function setTranschain($transchain): Choice
    {
        $this->transchain = $transchain;

        return $this;
    }

    public function getTranschain()
    {
        return $this->transchain;
    }
}
