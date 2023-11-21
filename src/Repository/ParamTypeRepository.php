<?php

namespace App\Repository;

use App\Entity\ParamType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ParamType>
 *
 * @method ParamType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParamType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParamType[]    findAll()
 * @method ParamType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParamTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParamType::class);
    }

//    /**
//     * @return ParamType[] Returns an array of ParamType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ParamType
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
