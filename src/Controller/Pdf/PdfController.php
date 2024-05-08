<?php

namespace App\Controller\Pdf;

use App\Entity\ReportAnalysis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Dompdf\Dompdf;

#[IsGranted('ROLE_STUDENT')]
class PdfController extends AbstractController
{
   #[Route('/dashboard/student/report/{id<\d+>}/{type}/pdf', name: 'report_pdf')]
   public function generateReportPdf(?ReportAnalysis $reportAnalysis, $type)
   {

      /** @var \App\Entity\User $student */
      $student = $this->getUser();

      if ($reportAnalysis->getReport()->getStudent() !== $student) {
         $this->addFlash('error', "Nie masz dostępu do tego Planu!");
         return $this->redirectToRoute('student_report', ['id' => $reportAnalysis->getId()]);
      }

      $dompdf = new Dompdf();

      $html = match ($type) {
         "recommendations" => $reportAnalysis->getRecommendations(),
         "NutritionPlan" => $reportAnalysis->getNutritionPlan(),
         "TrainingPlan" => $reportAnalysis->getTrainingPlan(),
         default => null
      };

      if (!$html) {
         $this->addFlash('error', "Coś poszło nie tak spróbuj ponownie jeszcze raz!");
         return $this->redirectToRoute('student_report', ['id' => $reportAnalysis->getId()]);
      }

      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'landscape');
      $dompdf->render();

      $fileName = match ($type) {
         "recommendations" => "zalecenia-" . $reportAnalysis->getDateAnalysis()->format('Y-m-d'),
         "NutritionPlan" => "plan-zywieniowy-" . $reportAnalysis->getDateAnalysis()->format('Y-m-d'),
         "TrainingPlan" => "plan-treningowy-" . $reportAnalysis->getDateAnalysis()->format('Y-m-d'),
      };

      $dompdf->stream($fileName);
   }
}
