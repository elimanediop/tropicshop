<?php

namespace App\Repository;

use App\Entity\ProduitStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProduitStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitStore[]    findAll()
 * @method ProduitStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitStore::class);
    }

    // /**
    //  * @return ProduitStore[] Returns an array of ProduitStore objects
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
    public function findOneBySomeField($value): ?ProduitStore
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
