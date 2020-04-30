<?php

namespace App\Repository;

use App\Entity\TypePet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypePet|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePet|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePet[]    findAll()
 * @method TypePet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePet::class);
    }

    // /**
    //  * @return TypePet[] Returns an array of TypePet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypePet
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByName($name): ?TypePet
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
