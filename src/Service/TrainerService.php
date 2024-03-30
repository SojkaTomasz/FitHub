<?php

namespace App\Service;

use App\Entity\Report;
use App\Repository\ReportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TrainerService
{
   private EntityManagerInterface $entityManager;
   private ReportRepository $reportRepository;
   public function __construct(EntityManagerInterface $entityManager, ReportRepository $reportRepository)
   {
      $this->entityManager = $entityManager;
      $this->reportRepository = $reportRepository;
   }

   public function itsMyStudent(?Report $id, $trainer)
   {
      $reportsTrainer =  $this->reportRepository->findReportsStudentForTrainer($trainer->getId());
      $report = $this->entityManager->getRepository(Report::class)->find($id);

      $reportsTrainerId = array_map(function ($reportTrainer) {
         return $reportTrainer->getStudent()->getId();
      }, $reportsTrainer);

      if (!in_array($report->getStudent()->getId(), $reportsTrainerId)) {
         throw new AccessDeniedException();
      }
   }
}
