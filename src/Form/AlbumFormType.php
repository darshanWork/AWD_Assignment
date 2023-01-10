<?php

namespace App\Form;

use App\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Title...'
                ),
                'label' => false
            ])
            ->add('artist', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Artist...'
                ),
                'label' => false
            ])
            ->add('genre', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Genre...'
                ),
                'label' => false
            ])
            ->add('track_list', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => [
                    'attr' => ['placeholder' => 'Enter Track...']
                ],
                'allow_add' => true,
                'prototype' => true,
                'label' => 'Track List'
            ])
            ->add('submit', SubmitType::class, ['label' => 'Create Album'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
