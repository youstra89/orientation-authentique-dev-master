<?php

namespace App\Repository;

use App\Entity\HDS;
use App\Entity\Search\HDSSearch;
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
    public function myFindAllQuery(HDSSearch $search)
    {
        $query = $this->createQueryBuilder('h')
            ->orderBy('h.nom', 'ASC');

        if($search->getNom()){
          $query = $query
            ->andWhere('h.nom LIKE :nom OR h.pnom LIKE :nom')
            ->setParameter('nom', '%'.addcslashes($search->getNom(), '%_').'%');
        }

        if($search->getCommune()){
          $query = $query
            ->andWhere('h.commune = :commune')
            ->setParameter('commune', $search->getCommune()->getId());
        }

        if($search->getRegion()){
          $query = $query
            ->join('h.commune', 'c')
            ->addSelect('c')
            ->join('c.ville', 'v')
            ->addSelect('v')
            ->join('v.region', 'r')
            ->addSelect('r')
            ->andWhere('v.region = :region')
            ->setParameter('region', $search->getRegion()->getId());
        }

        return $query->getQuery();
    }


    public function myCount()
    {
        return $this->createQueryBuilder('h')
            ->select('count(h.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

}
