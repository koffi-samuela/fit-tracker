<?php

namespace App\Repository;

use App\Entity\Workout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Workout>
 *
 * @method Workout|null find($id, $lockMode = null, $lockVersion = null)
 * @method Workout|null findOneBy(array $criteria, array $orderBy = null)
 * @method Workout[]    findAll()
 * @method Workout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkoutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workout::class);
    }

//    /**
//     * @return Workout[] Returns an array of Workout objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Workout
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function findCurrentWeekUserWorkout(int $user_id)
{
    return $this->createQueryBuilder("w")
                ->leftJoin("w.contain", "c")
                ->leftJoin("w.register", "u")
                ->leftJoin("w.workoutExercices", "w_e")
                ->leftJoin("exercices", "e")
                ->andWhere("u.id = :user_id" )
                ->orderBy("w.date", "DESC")
                ->setParameter("user_id", $user_id)
                ->getQuery()
                ->getResult();
}

// 1. Dans la classe WorkoutRepository de l’entité Workout, 
// définir une méthode findCurrentWeekUserWorkout.
// 2. A l’aide du queryBuider doctrine, créer à l’intérieur de 
// cette méthode, une requête permettant de récupérer la 
// LA MANU, Ecole des Métiers du Numérique est une marque déposée de NOVEI Formation.
// NOVEI Formation – 1435 boulevard Cambronne – 60400 Noyon – SIRET 752 434 605 00024, Code activité 8559A - Déclaration 
// activité N° 32 6003047 60 (enregistrée auprès du Préfet de Région Hauts-de-France). SARL au capital de 20250 euros – RCS 
// Versailles 752 434 605 – SIRET siège social NOVEI 752 434 605 00073 – TVA intracommunautaire FR46752434605
//  6
// liste des entraînements (workouts), pour la semaine en 
// cours de l'utilisateur connecté.
// Pour cela, il faudrait que vous utilisiez le champ date qui  est un datetime et qu’il soit comparable au jour actuel.

}
