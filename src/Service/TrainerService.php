<?php

namespace App\Service;

use App\Entity\Report;
use App\Entity\ReportAnalysis;
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

   public function itsMyStudent(?Report $report, $trainer)
   {
      if ($trainer->getId() != $report->getTrainer()->getId()) {
         throw new AccessDeniedException();
      }
   }
}
