<?php

namespace App\Repository;

use App\Entity\PageEleve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageEleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageEleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageEleve[]    findAll()
 * @method PageEleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageEleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageEleve::class);
    }

    // /**
    //  * @return PageEleve[] Returns an array of PageEleve objects
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
    public function findOneBySomeField($value): ?PageEleve
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
