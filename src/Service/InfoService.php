<?php

namespace App\Service;

use App\Entity\Info;
use App\Entity\Questionnaire;
use App\Entity\Report;
use App\Entity\ReportAnalysis;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class InfoService
{

   public function __construct(
      private EntityManagerInterface $entityManager,
   ) {
   }
   public function newInfo(string $action, User $user, ReportAnalysis | Report | User | Questionnaire $typeInfo = null)
   {
      if ($typeInfo !== null && !empty($typeInfo->getInfos()["elements"])) {
         $this->closeInfo($typeInfo->getInfos());
      }
      $info = new Info;
      $info->setCreatedAt(new \DateTimeImmutable());
      $info->setAction($action);
      $info->setUser($user);

      if ($typeInfo instanceof ReportAnalysis)  $info->setReportAnalysis($typeInfo);
      if ($typeInfo instanceof Report)  $info->setReport($typeInfo);
      if ($typeInfo instanceof User) $info->setNewStudent($typeInfo);
      if ($typeInfo instanceof Questionnaire) $info->setQuestionnaire($typeInfo);

      $this->entityManager->persist($info);
   }

   public function closeInfo(?Collection $infos)
   {
      if ($infos !== null) {
         foreach ($infos as $info) {
            if ($info->getSeedAt() === null) {
               $info->setSeedAt(new \DateTimeImmutable());
               $this->entityManager->persist($info);
               $this->entityManager->flush();
            }
         }
      }
   }

   public function closeInfoNewStudent(?Collection $infos, User $student)
   {
      if ($infos !== null) {
         foreach ($infos as $info) {
            if ($info->getSeedAt() === null && $info->getNewStudent() === $student) {
               $info->setSeedAt(new \DateTimeImmutable());
               $this->entityManager->persist($info);
               $this->entityManager->flush();
            }
         }
      }
   }
   public function closeInfoQuestionnaire(?Collection $infos)
   {
      if ($infos !== null) {
         foreach ($infos as $info) {
            if ($info->getAction() === "questionnaire-student") {
               $info->setSeedAt(new \DateTimeImmutable());
               $this->entityManager->persist($info);
               $this->entityManager->flush();
            }
         }
      }
   }
}
