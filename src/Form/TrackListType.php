<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TrackListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('track1', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Track...'
                ),
                'label' => false
            ])
            ->add('track2', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Track...'
                ),
                'label' => false
            ])->add('track3', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Track...'
                ),
                'label' => false
            ])
            ->add('track4', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Track...'
                ),
                'label' => false
            ])
            ->add('track5', TextType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Track...'
                ),
                'label' => false
            ])
        ;
    }

}
