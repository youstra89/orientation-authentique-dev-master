<?php

namespace App\Repository;

use App\Entity\Mosquee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mosquee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mosquee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mosquee[]    findAll()
 * @method Mosquee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MosqueeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mosquee::class);
    }

//    /**
//     * @return Mosquee[] Returns an array of Mosquee objects
//     */
    public function myFindAllQuery()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.nom', 'ASC')
            ->getQuery()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Mosquee
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
