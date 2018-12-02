<?php

namespace App\Repository;

use App\Entity\Ecole;
use App\Entity\Search\EcoleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ecole|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecole|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecole[]    findAll()
 * @method Ecole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcoleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ecole::class);
    }

//    /**
//     * @return Ecole[] Returns an array of Ecole objects
//     */
public function myFindAllQuery(EcoleSearch $search)
{
    $query = $this->createQueryBuilder('e')
        ->orderBy('e.nom', 'ASC');

    if($search->getNom()){
      $query = $query
        ->andWhere('e.nom LIKE :nom')
        ->setParameter('nom', '%'.$search->getNom().'%');
    }

    if($search->getCommune()){
      $query = $query
        ->andWhere('e.commune = :commune')
        ->setParameter('commune', $search->getCommune()->getId());
    }

    if($search->getRegion()){
      $query = $query
        ->join('e.commune', 'c')
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
    return $this->createQueryBuilder('e')
        ->select('count(e.id)')
        ->getQuery()
        ->getSingleScalarResult()
    ;
}
}
