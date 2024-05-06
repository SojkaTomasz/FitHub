<?php

namespace App\Repository;

use App\Entity\Report;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Report>
 *
 * @method Report|null find($id, $lockMode = null, $lockVersion = null)
 * @method Report|null findOneBy(array $criteria, array $orderBy = null)
 * @method Report[]    findAll()
 * @method Report[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function findMyReports(int $studentId): array
    {
        return $this->createQueryBuilder('r')
            ->where('r.student  = :studentId')
            ->setParameter('studentId', $studentId)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->execute();
    }

    public function findLastReport(int $idSelectedReport, DateTime $dateSelectedReport): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.student  = :id')
            ->andWhere('r.date < :date')
            ->setParameter('id', $idSelectedReport)
            ->setParameter('date', $dateSelectedReport)
            ->orderBy('r.date', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->execute();
    }

    public function findReportsStudentForTrainer($trainer): array
    {
        return $this->createQueryBuilder('r')
            ->where('r.trainer = :trainer')
            ->setParameter('trainer', $trainer)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->execute();
    }
}
