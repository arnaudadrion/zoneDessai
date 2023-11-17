<?php

namespace App\Entity\Survey\Question;

use App\Repository\Survey\Question\ChoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=ChoiceRepository::class)
 * @ORM\Table(name="question_choice")
 */
class Choice
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $label;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $value;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @var AbstractQuestion
     * @ORM\ManyToOne(targetEntity=AbstractQuestion::class, inversedBy="choices", cascade={"persist"})
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
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

    /**
     * Set transchain
     *
     * @param string $transchain
     *
     * @return AbstractQuestion
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
}
