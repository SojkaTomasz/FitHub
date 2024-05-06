<?php

namespace App\Service;

use App\Entity\Report;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TrainerService
{
   public function itsMyStudent(?Report $report, $trainer)
   {
      if ($trainer->getId() != $report->getTrainer()->getId()) {
         throw new AccessDeniedException();
      }
   }
}
