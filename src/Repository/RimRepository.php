<?php

namespace App\Repository;

use App\Entity\Rim;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rim|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rim|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rim[]    findAll()
 * @method Rim[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RimRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rim::class);
    }

    // /**
    //  * @return Rim[] Returns an array of Rim objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rim
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
