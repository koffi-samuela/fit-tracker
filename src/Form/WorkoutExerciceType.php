<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Entity\Workout;
use App\Entity\WorkoutExercice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkoutExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number_of_repetitions')
            ->add('duration')
            ->add('exercice', EntityType::class, [
                'class' => Exercice::class,
                'choice_label' => 'id',
            ])
            ->add('workout', EntityType::class, [
                'class' => Workout::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkoutExercice::class,
        ]);
    }
}
