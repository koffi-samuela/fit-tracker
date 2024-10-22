<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasherInterface){

    }
    public function load(ObjectManager $manager): void
    {
        $roles = [
            'ROLE_ADMIN',
            'ROLE_USER'
        ] ;
        $faker = Faker::create('fr_FR');
        for ($i=0 ;$i<10 ; $i++){
            $user = new User();
            $user->setEmail( $faker->unique()->email());
            if ($i == 1) {
                $user->setRoles([$roles[0]]);
            } else {
                $user->setRoles([$roles[1]]);

            }
            // Le mot de passe est "secret"
            $hashedPassword = $this->userPasswordHasherInterface->hashPassword($user, 'secret');
            $user->setPassword($hashedPassword);
            $user->setFirstname( $faker->firstName()) ;
            $user->setLastname( $faker->lastName() ) ;
            $user->setBirthdate( $faker->dateTimeBetween('-60 years', '-18 years'));
            $user->setGoal($faker->sentence(7));

            //ajout de référence
            $this->addReference("user_".$i , $user );
            $manager->persist($user);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
