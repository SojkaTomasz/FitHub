<?php

namespace App\Repository;

use App\Entity\ReportAnalysis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReportAnalysis>
 *
 * @method ReportAnalysis|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportAnalysis|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportAnalysis[]    findAll()
 * @method ReportAnalysis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportAnalysisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportAnalysis::class);
    }

    //    /**
    //     * @return ReportAnalysis[] Returns an array of ReportAnalysis objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ReportAnalysis
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
