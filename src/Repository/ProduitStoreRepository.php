<?php


namespace App\Repository;

use App\Entity\ProduitStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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
}