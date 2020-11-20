<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findAllStoresByLatLon($lat, $lon, $ray = 5)
    {
        $sqlDistance = '(6378 * acos(cos(radians(' . $lat
            . ')) * cos(radians(c.lat)) * cos(radians(c.lon) - radians(' . $lon .
            ')) + sin(radians(' . $lat . ')) * sin(radians(c.lat))))';

        return $this->createQueryBuilder('c')
            ->andWhere(':where < :ray')
            ->setParameter('where', $sqlDistance)
            ->setParameter('ray', $ray)
            ->getQuery()
            ->getResult();

    }

    public function findOneByEmail(string $email)
    {
        return $this->createQueryBuilder('c')
            ->Where("c.mail = '$email'")
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByNameLike($nom)
    {
        return $this->createQueryBuilder('u')
            ->where('u.nom LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%')
            ->getQuery()
            ->getResult()
            ;
    }


}
