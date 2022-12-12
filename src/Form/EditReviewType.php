<?php

namespace App\Form;

use App\Repository\ReviewRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class EditReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$reviews[] = ReviewRepository::class->findAll();

        $builder
            /**
             * ->add('id', ChoiceType::class, ['label' => 'Choose Review',
            'choices' => [$reviews]])
             */
            ->add('id', ChoiceType::class, ['label' => 'Choose Review',
                'choices' => $options])
            ->add('review_text', TextareaType::class, ['label' => 'Review'])
            ->add('submit_type', SubmitType::class, ['label' => 'Submit']);
    }
}