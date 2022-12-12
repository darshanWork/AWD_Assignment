<?php

namespace App\Form;

use App\Entity\Album;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['required' => true, 'label'
            => 'Title'])
            ->add('artist', TextType::class, ['required' => true, 'label'
            => 'Artist'])
            ->add('genre', TextType::class, ['required' => true, 'label'
            => 'Genre'])
            ->add('track_list', TextareaType::class, ['label' => "Track List"])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}