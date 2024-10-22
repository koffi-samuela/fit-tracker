<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker ;

class ExercicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create( 'fr_FR' );
        for($i=0;$i<10;$i++){
            $exercice = new Exercice();
            $exercice->setName($faker->name);
            //phrase avec une limite de 255 charactère
            $exercice->setDescription($faker->sentence(8,true)) ;

            //ajout des références
            $this->addReference("exercice_".$i,$exercice);
            //persistance en BDD
            $manager->persist($exercice) ;

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
