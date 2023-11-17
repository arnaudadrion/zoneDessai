<?php

namespace App\Entity\Survey\Question;

use App\Entity\Survey\Survey;
use App\Repository\Survey\Question\AbstractQuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass=AbstractQuestionRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "text" = "TextQuestion",
 *     "multiple" = "MultipleChoiceQuestion",
 *     "choice" = "ChoiceQuestion",
 *     "integer" = "IntegerQuestion",
 *     "float" = "FloatQuestion",
 *     "bool" = "BooleanQuestion",
 *     "order" = "OrderQuestion",
 * })
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 */
abstract class AbstractQuestion
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
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $weight = 1;

    /**
     * @ORM\ManyToOne(targetEntity=Survey::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $survey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transchain;

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        $class = (new \ReflectionClass($this))->getName();
        switch($class) {
            case MultipleChoiceQuestion::class:
                return 'MCQ';
            case ChoiceQuestion::class:
                return 'SQC';
            case IntegerQuestion::class:
                return 'Number';
            case FloatQuestion::class:
                return 'Decimal';
            case BooleanQuestion::class:
                return 'Yes/No';
            case OrderQuestion::class:
                return 'Order';
            case TextQuestion::class:
            default:
                return 'Text';
        }
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight)
    {
        $this->weight = $weight;
    }

    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getMaximumScore()
    {
        return null;
    }

    public function __toString()
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
