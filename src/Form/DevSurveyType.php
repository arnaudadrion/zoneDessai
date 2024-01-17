<?php

namespace App\Form;

use App\Entity\Survey\Question\Choice;
use App\Entity\Survey\Question\ChoiceQuestion;
use App\Entity\Survey\Question\MultipleChoiceQuestion;
use App\Entity\Survey\Survey;
use ReflectionClass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DevSurveyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Survey $survey */
        $survey = $builder->getData();
        foreach ($survey->getQuestions() as $question) {
            $answerClass = (new ReflectionClass($question))->getShortName();
            $type = 'AdminBundle\Form\Survey\Question\\'.$answerClass.'Type';

            // DEFAULT OPTIONS
            $options = [
                'mapped' => false,
                'label' => $question->getLabel() . ' (poids de ' . $question->getWeight() . ')',
            ];

            // PASS CHOICES IN PARAMETERS
            if ($question instanceof ChoiceQuestion || $question instanceof MultipleChoiceQuestion) {
                $options['choices'] = $question->getChoices();
                $options['choice_label'] = function (Choice $choice) {
                    return $choice->getLabel() . ' (' . $choice->getValue() . ' pts)';
                };
                // $options['preferred_choices'] = [$question->getAnswer()->getChoices()];
            }

            $builder->add('question-'.$question->getId(), $type, $options);
        }
    }
}
