<?php

namespace App\Service;

use App\Entity\Info;
use App\Entity\ReportAnalysis;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class InfoService
{

   public function __construct(
      private EntityManagerInterface $entityManager,
   ) {
   }
   public function newInfo(string $action, User $user, ReportAnalysis $reportAnalysis)
   {
      $info = new Info;
      $info->setCreatedAt(new \DateTimeImmutable());
      $info->setAction($action);
      $info->setUser($user);
      $info->setReportAnalysis($reportAnalysis);
      $this->entityManager->persist($info);
   }
}
