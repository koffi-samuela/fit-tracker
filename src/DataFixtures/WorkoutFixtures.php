<?php

namespace App\DataFixtures;

use App\Entity\Workout;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker ;
class WorkoutFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $types_of_workout = ["Jambes", "Epaules","Pectoraux", "Fessiers","Dos","Abdos"];
        $faker = Faker::create('fr_FR');
        for ($i=0;$i<10;$i++){
            $workout = new Workout();
            $workout->setUser($this->getReference("user_".$faker->numberBetween(0,9)));
            //DATE SUR LES 10 DERNIERS JOURS
            $workout->setDate($faker->dateTimeBetween("-10 days","now"));
            $workout->setNotes( $faker ->sentence());
            $workout->setTypeOfWorkout($types_of_workout[array_rand($types_of_workout)]);
            //ajout de réference
            $this->addReference("workout_".$i,$workout);
            $manager->persist($workout);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
