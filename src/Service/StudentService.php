<?php

namespace App\Service;

use App\Entity\Report;
use App\Repository\ReportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class StudentService
{
   private EntityManagerInterface $entityManager;
   private ReportRepository $reportRepository;
   public function __construct(EntityManagerInterface $entityManager, ReportRepository $reportRepository)
   {
      $this->entityManager = $entityManager;
      $this->reportRepository = $reportRepository;
   }
}
