<?php

namespace App\Repository;

use App\Entity\WorkoutExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WorkoutExercice>
 *
 * @method WorkoutExercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkoutExercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkoutExercice[]    findAll()
 * @method WorkoutExercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkoutExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkoutExercice::class);
    }

//    /**
//     * @return WorkoutExercice[] Returns an array of WorkoutExercice objects
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

//    public function findOneBySomeField($value): ?WorkoutExercice
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
