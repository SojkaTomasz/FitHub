<?php

namespace App\Repository;

use App\Entity\Report;
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

    public function findReportsStudentForTrainer(int $trainerId): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.student', 's')
            ->where('s.trainer = :trainerId')
            ->setParameter('trainerId', $trainerId)
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->execute();
    }
}
