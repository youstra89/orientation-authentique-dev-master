<?php

namespace App\Repository;

use App\Entity\Cours;
use App\Entity\Search\CoursSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cours[]    findAll()
 * @method Cours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cours::class);
    }

//    /**
//     * @return Cours[] Returns an array of Cours objects
//     */

public function myFindAllQuery(CoursSearch $search)
{
    $query = $this->createQueryBuilder('c')
        ->orderBy('c.id', 'ASC');

    if($search->getHds()){
      $query = $query
        ->join('c.hds', 'h')
        ->addSelect('h')
        ->andWhere('h.nom LIKE :nom  OR h.pnom LIKE :nom')
        ->setParameter('nom', '%'.$search->getHds().'%');
    }

    if($search->getDiscipline()){
      $query = $query
        ->andWhere('c.discipline = :discipline')
        ->setParameter('discipline', $search->getDiscipline()->getId());
    }

    if($search->getCommune()){
      $query = $query
        ->join('c.mosquee', 'm')
        ->addSelect('m')
        ->andWhere('m.commune = :commune')
        ->setParameter('commune', $search->getCommune()->getId());
    }

    if($search->getMosquee()){
      $query = $query
        ->andWhere('c.mosquee = :mosquee')
        ->setParameter('mosquee', $search->getMosquee()->getId());
    }

    return $query->getQuery();
}


    /*
    public function findOneBySomeField($value): ?Cours
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
