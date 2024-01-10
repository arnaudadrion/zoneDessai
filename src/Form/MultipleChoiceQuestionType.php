<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MultipleChoiceQuestionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        // CHECKBOX TYPE
        $resolver->setDefaults([
            'expanded' => false,
            'multiple' => true,
        ]);
    }

    public function getParent(): ?string
    {
        return ChoiceType::class;
    }
}
