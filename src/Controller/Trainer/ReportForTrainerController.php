<?php

namespace App\Controller\Trainer;

use App\Entity\Report;
use App\Entity\ReportAnalysis;
use App\Form\ReportAnalysisType;
use App\Repository\ReportRepository;
use App\Service\InfoService;
use App\Service\TrainerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_TRAINER')]
class ReportForTrainerController extends AbstractController
{
    #[Route('/dashboard/trainer/reports', name: 'trainer_reports')]
    public function reports(ReportRepository $reportRepository): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();
        $reports = $reportRepository->findReportsStudentForTrainer($trainer);
        return $this->render('dashboard/trainer/reports.html.twig', [
            'reports' => $reports,
        ]);
    }

    #[Route('/dashboard/trainer/report/{id<\d+>}', name: 'trainer_report')]
    public function report(?Report $report, ReportRepository $reportRepository, TrainerService $trainerService): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$report) {
            $this->addFlash('error', "Nie ma takiego raportu");
            return $this->redirectToRoute('trainer_reports');
        }
        $trainerService->itsMyStudent($report, $trainer);

        $idSelectedReport = $report->getStudent()->getId();
        $dateSelectedReport = $report->getDate();
        $lastReport = $reportRepository->findLastReport($idSelectedReport, $dateSelectedReport);

        return $this->render('dashboard/student-trainer/report.html.twig', [
            'report' => $report,
            'lastReport' =>  $lastReport,
        ]);
    }

    #[Route('/dashboard/trainer/report-analysis/{id<\d+>}', name: 'trainer_report_add_analysis')]
    public function reportAnalysis(EntityManagerInterface $entityManager, Request $request, ?Report $report, TrainerService $trainerService, InfoService $infoService): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$report) {
            $this->addFlash('error', "Nie ma takiego raportu");
            return $this->redirectToRoute('trainer_reports');
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
            $infoService->newInfo("Nowa Analiza Raportu", $report->getStudent(), $reportAnalysis);
            $entityManager->persist($report);
            $entityManager->persist($reportAnalysis);
            $entityManager->flush();

            $this->addFlash('success', "Raport poprawnie przeanalizowany!");
            return $this->redirectToRoute('trainer_reports');
        }

        return $this->render('dashboard/trainer/reportAnalysis.html.twig', [
            'report' => $report,
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/trainer/report-analysis/edit/{id<\d+>}', name: 'trainer_report_analysis_edit')]
    public function reportAnalysisEdit(EntityManagerInterface $entityManager, Request $request, ?ReportAnalysis $reportAnalysis): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if (!$reportAnalysis) {
            $this->addFlash('error', "Nie ma takiego raportu");
            return $this->redirectToRoute('trainer_reports');
        }

        if ($reportAnalysis->getTrainer() !== $trainer) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(ReportAnalysisType::class, $reportAnalysis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reportAnalysis);
            $entityManager->flush();
            $this->addFlash('success', "Analiza raportu poprawnie edytowana!");
            return $this->redirectToRoute('trainer_reports');
        }

        return $this->render('dashboard/trainer/reportAnalysis_edit.html.twig', [
            'report' => $reportAnalysis->getReport(),
            'form' => $form,
        ]);
    }
}
