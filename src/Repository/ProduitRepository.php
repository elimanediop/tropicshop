<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

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
    public function findByTypeproduit($value, bool $isdefault)
    {
        return $this->createQueryBuilder('p')
            ->where('p.isdefault = :default')
            ->setParameter('default', $isdefault)
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
    public function findByNameLike($nom)
    {
        return $this->createQueryBuilder('p')
            ->where('p.nom LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%')
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
    public function findOneByUserId(int $id, int $store_id, bool $isdefault=true)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->andWhere('p.isdefault = :isdefault')
            ->andWhere('p.store = :store')
            ->setParameter('id', $id)
            ->setParameter('isdefault', $isdefault)
            ->setParameter('store', $store_id)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findByTerm($term, bool $isdefault)
    {
        return $this->createQueryBuilder('p')
            ->select("u.id, p.id as produit_id, u.nommagasin, u.adresse, u.codepostal, u.ville, p.nom" )
            ->innerJoin("App\Entity\User", 'u', Join::WITH,"u.id  = p.store")
            ->andWhere("p.nom like :val")
            ->andwhere('isdefualt = :default')
            ->setParameter('default', $isdefault)
            ->setParameter('val', "%$term%")
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findByTermAndLocation($term, $lat, $lon, bool $isdefault=true, $ray = 5)
    {
        $sqlDistance = '(6378 * acos(cos(radians(' . $lat
            . ')) * cos(radians(u.lat)) * cos(radians(u.lon) - radians(' . $lon .
            ')) + sin(radians(' . $lat . ')) * sin(radians(u.lat))))';
        return $this->createQueryBuilder('p')
            ->select("u.id, p.id as produit_id, u.nommagasin, u.adresse, u.codepostal, u.ville, p.nom" )
            ->innerJoin("App\Entity\User", 'u', Join::WITH,"u.id  = p.store")
            ->andWhere("p.nom like :val")
            ->andWhere(':where < :ray')
            ->setParameter('where', $sqlDistance)
            ->setParameter('ray', $ray)
            ->andwhere('p.isdefault = :default')
            ->setParameter('default', $isdefault)
            ->setParameter('val', "%$term%")
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findByLocation($lat, $lon, $ray = 5, bool $isdefault)
    {
        $sqlDistance = '(6378 * acos(cos(radians(' . $lat
            . ')) * cos(radians(u.lat)) * cos(radians(u.lon) - radians(' . $lon .
            ')) + sin(radians(' . $lat . ')) * sin(radians(u.lat))))';
        $results = $this->createQueryBuilder('p')
            ->select("u.id, p.id as produit_id, u.nommagasin, u.adresse, u.codepostal, u.ville, p.nom" )
            ->innerJoin("App\Entity\User", 'u', Join::WITH,"u.id  = p.store")
            ->andWhere(':where < :ray')
            ->where('isdefualt = :default')
            ->setParameter('default', $isdefault)
            ->setParameter('where', $sqlDistance)
            ->setParameter('ray', $ray)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
        return $this->cleanByStoreId($results);
    }

    public function cleanByStoreId($results){
        $productsByStoreId = [];
        foreach ($results as $result){
            $productsByStoreId[$result['id']] = $result;
        }
        return $productsByStoreId;
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
