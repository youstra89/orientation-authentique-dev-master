<?php

namespace App\Repository;

use App\Entity\Mosquee;
use App\Entity\Search\MosqueeSearch;
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
    public function myFindAllQuery(MosqueeSearch $search)
    {
        $query = $this->createQueryBuilder('m')
            ->orderBy('m.nom', 'ASC');

        if($search->getNom()){
          $query = $query
            ->andWhere('m.nom LIKE :nom')
            ->setParameter('nom', '%'.$search->getNom().'%');
        }

        if($search->getCommune()){
          $query = $query
            ->andWhere('m.commune = :commune')
            ->setParameter('commune', $search->getCommune()->getId());
        }

        if($search->getRegion()){
          $query = $query
            ->join('m.commune', 'c')
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
        return $this->createQueryBuilder('m')
            ->select('count(m.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
