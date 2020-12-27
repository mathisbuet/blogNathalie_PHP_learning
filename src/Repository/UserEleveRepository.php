<?php

namespace App\Repository;

use App\Entity\UserEleve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserEleve|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEleve|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEleve[]    findAll()
 * @method UserEleve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserEleveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEleve::class);
    }

    // /**
    //  * @return UserEleve[] Returns an array of UserEleve objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserEleve
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
