<?php

namespace App\Service;

use App\Entity\Info;
use App\Entity\Report;
use App\Entity\ReportAnalysis;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class InfoService
{

   public function __construct(
      private EntityManagerInterface $entityManager,
   ) {
   }
   public function newInfo(string $action, User $user, $typeInfo)
   {
      $info = new Info;
      $info->setCreatedAt(new \DateTimeImmutable());
      $info->setAction($action);
      $info->setUser($user);

      if ($typeInfo instanceof ReportAnalysis)  $info->setReportAnalysis($typeInfo);
      if ($typeInfo instanceof Report)  $info->setReport($typeInfo);

      $this->entityManager->persist($info);
   }

   public function closeInfo(Info $info)
   {
      if ($info !== null) {
         $info->setSeedAt(new \DateTimeImmutable());
         $this->entityManager->persist($info);
         $this->entityManager->flush();
      }
   }
}
