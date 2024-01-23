<?php

namespace App\Form;

use App\Entity\Features;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

;

class FeatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom de la feature'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Descriptif',
            ])
            ->add('link', TextType::class, [
                'label' => 'Nom de la route'
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du parametre',
                'mapped' => false,
                'required' => false
            ])
            ->add('value', TextType::class, [
                'label' => 'Valeur',
                'mapped' => false,
                'required' => false
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Features::class,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'feature';
    }
}