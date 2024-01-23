<?php

namespace App\Form\Survey;

use App\Entity\Survey\Question\ChoiceQuestion;
use App\Entity\Survey\Question\MultipleChoiceQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminLinkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $questions = $builder->getData()->getQuestions();
        foreach ($questions as $question) {
            if ($question instanceof ChoiceQuestion || $question instanceof MultipleChoiceQuestion) {
                $choices = $question->getChoices();
                foreach ($choices as $choice) {
                    foreach ($questions as $question2) {
                        if ($question !== $question2) {
                            $choices2 = $question2->getChoices();
                            foreach ($choices2 as $choice2) {
                                $builder->add('question-' . $question->getId() . '-' . $choice->getId() . '-'. $question2->getId() . '-' . $choice2->getId(), IntegerType::class, [
                                    'mapped' => false,
                                    'label' => 'Q' . $question->getId() . ' - C' . $choice->getId() . ' - Q'. $question2->getId() . ' - C' . $choice2->getId(),
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
