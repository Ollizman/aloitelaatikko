<?php

namespace App\Repository;

use App\Entity\Aloitelaatikko;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Aloitelaatikko|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aloitelaatikko|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aloitelaatikko[]    findAll()
 * @method Aloitelaatikko[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AloitelaatikkoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aloitelaatikko::class);
    }

    // /**
    //  * @return Aloitelaatikko[] Returns an array of Aloitelaatikko objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aloitelaatikko
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
