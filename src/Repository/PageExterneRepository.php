<?php

namespace App\Repository;

use App\Entity\PageExterne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageExterne|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageExterne|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageExterne[]    findAll()
 * @method PageExterne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageExterneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageExterne::class);
    }

    // /**
    //  * @return PageExterne[] Returns an array of PageExterne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageExterne
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
