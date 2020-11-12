<?php

namespace App\Repository;

use App\Entity\Stock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stock[]    findAll()
 * @method Stock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stock::class);
    }

    // /**
    //  * @return Stock[] Returns an array of Stock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stock
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByIdStore($idStore)
    {

        return $this->createQueryBuilder('s')
            ->innerJoin("App\Entity\ProduitStore", 'p', Join::WITH,"p.id  = s.produitStore")
            ->where('p.store = :id')
            ->setParameter('id', $idStore)
            ->getQuery()
            ->getResult()
            ;
    }

    public function arrayAssocKeyProduitStoreStock($idStore){
        $assocStock = [];
        $stocks = $this->findByIdStore($idStore);
        foreach ($stocks as $stock){
            $assocStock[$stock->getProduitStore()->getId()] = $stock;
        }
        return $assocStock;
    }
}
