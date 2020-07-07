<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
    * @return Produit[] Returns an array of Produit objects
    */
    public function findByTypeproduit($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typeproduit = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findByUserId($id)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.store = :val')
            ->setParameter('val', $id)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findByTerm($term)
    {
        return $this->createQueryBuilder('p')
            ->select("u.id, p.id as produit_id, u.nommagasin, u.adresse, u.codepostal, u.ville, p.nom" )
            ->innerJoin("App\Entity\User", 'u', Join::WITH,"u.id  = p.store")
            ->andWhere("p.nom like :val")
            ->setParameter('val', "%$term%")
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }





    /*
    public function findOneBySomeField($value): ?Produit
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
