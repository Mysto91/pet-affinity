<?php

namespace App\Repository;

use App\Entity\Pet;
use App\Entity\PetSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pet[]    findAll()
 * @method Pet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pet::class);
    }

    // /**
    //  * @return Pet[] Returns an array of Pet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /**
     * @param $search
     *
     * @return Query
     */
    public function findAllQuery(PetSearch $search = null)
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.Name', 'ASC');

        if ($search->getMaxAge()) {
            $query = $query
                ->andWhere('p.age <= :maxage')
                ->setParameter('maxage', $search->getMaxAge());
        }

        if ($search->getMaxSize()) {
            $query = $query
                ->andWhere('p.size <= :maxsize')
                ->setParameter('maxsize', $search->getMaxSize());
        }

        return $query->getQuery();
    }

    /*
    public function findOneBySomeField($value): ?Pet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
