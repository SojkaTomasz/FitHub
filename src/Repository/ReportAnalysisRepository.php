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


    public function findMyReportsAnalysis(int $studentId): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.report', 'report')
            ->andWhere('report.student  = :studentId')
            ->setParameter('studentId', $studentId)
            ->orderBy('r.dateAnalysis', 'DESC')
            ->getQuery()
            ->execute();
    }
}
