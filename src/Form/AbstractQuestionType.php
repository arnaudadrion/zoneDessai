<?php

namespace App\Form;

use App\Entity\Survey\Question\AbstractQuestion;
use App\Entity\Survey\Question\BooleanQuestion;
use App\Entity\Survey\Question\ChoiceQuestion;
use App\Entity\Survey\Question\FloatQuestion;
use App\Entity\Survey\Question\IntegerQuestion;
use App\Entity\Survey\Question\MultipleChoiceQuestion;
use App\Entity\Survey\Question\SelectQuestion;
use App\Entity\Survey\Question\TextQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbstractQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Choix multiple' => MultipleChoiceQuestion::class,
                    'Choix simple en select' => SelectQuestion::class,
                    'Choix simple' => ChoiceQuestion::class,
                    'Nombre entier' => IntegerQuestion::class,
                    'Nombre décimale' => FloatQuestion::class,
                    'Choix binaire' => BooleanQuestion::class,
                    'Texte' => TextQuestion::class
                ],
                'expanded' => false,
                'multiple' => false
            ])
            ->add('weight')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AbstractQuestion::class,
        ]);
    }
}
