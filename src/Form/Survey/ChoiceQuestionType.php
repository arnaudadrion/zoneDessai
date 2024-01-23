<?php

namespace App\Form\Survey;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceQuestionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        // RADIO TYPE
        $resolver->setDefaults([
            'expanded' => true,
        ]);
    }

    public function getParent(): ?string
    {
        return ChoiceType::class;
    }
}
