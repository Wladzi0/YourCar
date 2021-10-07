<?php

namespace App\Repository;

use App\Entity\HelperController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HelperController|null find($id, $lockMode = null, $lockVersion = null)
 * @method HelperController|null findOneBy(array $criteria, array $orderBy = null)
 * @method HelperController[]    findAll()
 * @method HelperController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HelperControllerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HelperController::class);
    }

    // /**
    //  * @return HelperController[] Returns an array of HelperController objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HelperController
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
