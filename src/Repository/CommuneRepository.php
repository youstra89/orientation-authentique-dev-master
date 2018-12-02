<?php

namespace App\Repository;

use App\Entity\Commune;
use App\Entity\Search\CommuneSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Commune|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commune|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commune[]    findAll()
 * @method Commune[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommuneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Commune::class);
    }

//    /**
//     * @return Commune[] Returns an array of Commune objects
//     */

    public function myFindAllQuery(CommuneSearch $search)
    {
        $query = $this->createQueryBuilder('c')
            ->orderBy('c.nom', 'ASC');

        if($search->getNom()){
          $query = $query
            ->andWhere('c.nom LIKE :nom')
            ->setParameter('nom', '%'.$search->getNom().'%');
        }

        if($search->getRegion()){
          $query = $query
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
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
