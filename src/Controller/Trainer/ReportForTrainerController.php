<?php

namespace App\Controller\Trainer;

use App\Entity\Report;
use App\Entity\ReportAnalysis;
use App\Form\ReportAnalysisType;
use App\Repository\ReportRepository;
use App\Service\TrainerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportForTrainerController extends AbstractController
{
    #[Route('/dashboard/trainer/reports', name: 'reports_student_for_trainer')]
    public function reports(ReportRepository $reportRepository): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();
        $reports = $reportRepository->findReportsStudentForTrainer($trainer->getId());
        return $this->render('dashboard/trainer/reports.html.twig', [
            'reports' => $reports,
        ]);
    }

    #[Route('/dashboard/trainer/report/{id}', name: 'report_trainer')]
    public function report(EntityManagerInterface $entityManager, ?Report $id, TrainerService $trainerService): Response
    {

        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$id) {
            $this->addFlash('error', "Nie ma takiego raportu!");
            return $this->redirectToRoute('reports_student_for_trainer');
        }

        $report = $entityManager->getRepository(Report::class)->find($id);

        $trainerService->itsMyStudent($id, $trainer);

        return $this->render('dashboard/student-trainer/report.html.twig', [
            'report' => $report,
        ]);
    }

    #[Route('/dashboard/trainer/report-analysis/{id}', name: 'report_analysis')]
    public function reportAnalysis(EntityManagerInterface $entityManager, Request $request, ?Report $id, TrainerService $trainerService): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$id) {
            $this->addFlash('error', "Nie ma takiego raportu!");
            return $this->redirectToRoute('reports_student_for_trainer');
        }

        $report = $entityManager->getRepository(Report::class)->find($id);

        $trainerService->itsMyStudent($id, $trainer);

        $reportAnalysis = new ReportAnalysis();
        $form = $this->createForm(ReportAnalysisType::class, $reportAnalysis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reportAnalysis->setDateAnalysis(new \DateTime());
            $reportAnalysis->setReport($report);
            $report->setVerified(true);
            $entityManager->persist($report);
            $entityManager->persist($reportAnalysis);
            $entityManager->flush();
            $this->addFlash('success', "Raport poprawnie przeanalizowany!");
            return $this->redirectToRoute('reports_student_for_trainer');
        }

        return $this->render('dashboard/trainer/reportAnalysis.html.twig', [
            'report' => $report,
            'form' => $form,
        ]);
    }
}
