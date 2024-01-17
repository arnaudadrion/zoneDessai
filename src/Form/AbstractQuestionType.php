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
                    'Choix multiple' => 'multiple',
                    'Choix simple en select' => 'choice',
                    'Choix simple' => 'choice',
                    'Nombre entier' => 'integer',
                    'Nombre décimale' => 'float',
                    'Choix binaire' => 'boolean',
                    'Texte' => 'text'
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
