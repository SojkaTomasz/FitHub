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
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
    public function report(EntityManagerInterface $entityManager, ?Report $report, ReportRepository $reportRepository, TrainerService $trainerService): Response
    {

        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$report) {
            $this->addFlash('error', "Nie ma takiego raportu!");
            return $this->redirectToRoute('student_reports');
        } else {
            $idSelectedReport = $report->getStudent()->getId();
            $dateSelectedReport = $report->getDate();
            $lastReport = $reportRepository->findMyLastReport($idSelectedReport, $dateSelectedReport);

            $trainerService->itsMyStudent($report, $trainer);

            return $this->render('dashboard/student-trainer/report.html.twig', [
                'report' => $report,
                'lastReport' =>  $lastReport,
            ]);
        }
    }

    #[Route('/dashboard/trainer/report-analysis/{id}', name: 'report_analysis')]
    public function reportAnalysis(EntityManagerInterface $entityManager, Request $request, ?Report $report, TrainerService $trainerService): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$report) {
            $this->addFlash('error', "Nie ma takiego raportu!");
            return $this->redirectToRoute('reports_student_for_trainer');
        }

        $trainerService->itsMyStudent($report, $trainer);

        $reportAnalysis = new ReportAnalysis();
        $form = $this->createForm(ReportAnalysisType::class, $reportAnalysis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $reportAnalysis->setDateAnalysis(new \DateTime());
            $reportAnalysis->setReport($report);
            $reportAnalysis->setTrainer($trainer);
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
    #[Route('/dashboard/trainer/report-analysis/edit/{id}', name: 'report_analysis_edit')]
    public function reportAnalysisEdit(EntityManagerInterface $entityManager, Request $request, ?ReportAnalysis $reportAnalysis): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$reportAnalysis) {
            $this->addFlash('error', "Nie ma takiego raportu!");
            return $this->redirectToRoute('reports_student_for_trainer');
        }

        if ($reportAnalysis->getTrainer() !== $trainer) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(ReportAnalysisType::class, $reportAnalysis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reportAnalysis);
            $entityManager->flush();
            $this->addFlash('success', "Raport poprawnie przeanalizowany!");
            return $this->redirectToRoute('reports_student_for_trainer');
        }

        return $this->render('dashboard/trainer/reportAnalysis_edit.html.twig', [
            'report' => $reportAnalysis->getReport(),
            'form' => $form,
        ]);
    }
}
