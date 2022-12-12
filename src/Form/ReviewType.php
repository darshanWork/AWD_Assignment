<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\Album;
use App\Repository\AlbumRepository;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$albums[] = AlbumRepository::class->findAll();

        $builder
            /**
             * ->add('album_id', ChoiceType::class, ['label' => 'Choose Album',
            'choices' => [$albums], 'choice_value' => 'title',
            'choice_label' => function (?Album $album) {
            return $album ? strtolower($album->getTitle()) : '';
            },
            'choice_attr' => function (?Album $album) {
            return $album ? ['class' => 'album_'.strtolower($album->getTitle())] : [];
            }])
             */
            ->add('album_id', ChoiceType::class, ['label' => 'Choose Album',
                'choices' => $options])
            ->add('review_text', TextareaType::class, ['label' => 'Review'])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}