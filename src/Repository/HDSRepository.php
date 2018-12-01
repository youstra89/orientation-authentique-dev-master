<?php

namespace App\Repository;

use App\Entity\HDS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HDS|null find($id, $lockMode = null, $lockVersion = null)
 * @method HDS|null findOneBy(array $criteria, array $orderBy = null)
 * @method HDS[]    findAll()
 * @method HDS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HDSRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HDS::class);
    }

//    /**
//     * @return HDS[] Returns an array of HDS objects
//     */
    public function myFindAllQuery()
    {
        return $this->createQueryBuilder('h')
            ->orderBy('h.nom', 'ASC')
            ->addOrderBy('h.pnom', 'ASC')
            ->getQuery()
        ;
    }

    /*
    public function findOneBySomeField($value): ?HDS
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
