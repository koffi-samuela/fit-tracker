<?php

namespace App\DataFixtures;

use App\Entity\WorkoutExercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker ;

class WorkoutExercicesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker =  Faker::create('fr_FR'); 
        
        for($i=0;$i<10;$i++){
            $workoutexercises = new WorkoutExercice();
            $workoutexercises->setDuration(rand(30,150));
            $workoutexercises->setNumberOfRepetitions(rand(8,15));
            //recuperation des références
            $workoutexercises->setExercice($this->getReference("exercice_".$faker->numberBetween(0,9)));
            $workoutexercises->setWorkout($this->getReference("workout_".$faker->numberBetween(0,9)));
            $manager->persist($workoutexercises);          

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            WorkoutFixtures::class,
            ExercicesFixtures::class
        ];
    }
}
