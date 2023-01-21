<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Review;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_id', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'label' => false
            ])
            ->add('album_id', EntityType::class, [
                'class' => Album::class,
                'choice_label' => 'title',
                'label' => false
            ])
            ->add('review_text', TextareaType::class, [
                'attr' => array(
                    'placeholder' => 'Enter Review...'
                ),
                'label' => false
            ])
            ->add('submit', SubmitType::class, ['label' => 'Add Review'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
