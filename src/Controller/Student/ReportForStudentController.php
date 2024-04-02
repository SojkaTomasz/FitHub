<?php

namespace App\Controller\Student;

use App\Entity\Report;
use App\Entity\ReportAnalysis;
use App\Form\ReportType;
use App\Repository\ReportRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ReportForStudentController extends AbstractController
{
    #[Route('/dashboard/student/reports', name: 'student_reports')]
    public function reports(ReportRepository $reportRepository): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $reports = $reportRepository->findMyReports($user->getId());
        return $this->render('dashboard/student/student_reports.html.twig', [
            'reports' => $reports,
            'date' => date('w'),
        ]);
    }

    #[Route('/dashboard/student/report/{id<\d+>}', name: 'report_student')]
    public function report(?Report $report, ReportRepository $reportRepository): Response
    {

        /** @var \App\Entity\User $student */
        $student = $this->getUser();
        if (!$report) {
            $this->addFlash('error', "Nie ma takiego raportu!");
            return $this->redirectToRoute('student_reports');
        }

        $idSelectedReport = $student->getId();
        $dateSelectedReport = $report->getDate();

        $lastReport = $reportRepository->findMyLastReport($idSelectedReport, $dateSelectedReport);;

        if ($report->getStudent() !== $student) {
            throw new AccessDeniedException('Nie masz dostępu do tego raportu!');
        }

        return $this->render('dashboard/student-trainer/report.html.twig', [
            'report' => $report,
            'lastReport' =>  $lastReport,
        ]);
    }

    #[Route('/dashboard/student/report/add', name: 'student_report_add')]
    public function new(?Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, ReportRepository $reportRepository, FileUploader $fileUploader): Response
    {
        $report = new Report();
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imagesReport = [
                'setFrontImg' => $form->get('frontImg')->getData(),
                'setSideImg' => $form->get('sideImg')->getData(),
                'setBackImg' => $form->get('backImg')->getData()
            ];

            $reportsDirectory = $this->getParameter('reports_directory');

            foreach ($imagesReport  as $key => $value) {
                if ($value) {
                    $uploadedFileName = $fileUploader->upload($value, $reportsDirectory);
                    $report->$key($uploadedFileName);
                }
            }
            
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $reports = $reportRepository->findMyReports($user->getId());
            $report->setWeightDifference($report->getWeight() - $reports[0]->getWeight());
            $report->setDate(new \DateTime());
            $report->setStudent($this->getUser());
            $report->setVerified(false);
            $entityManager->persist($report);
            $entityManager->flush();

            $this->addFlash('success', "Raport poprawnie wysłany!");
            return $this->redirectToRoute('student_reports');
        }

        return $this->render('dashboard/student/student_report_add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/dashboard/student/report/edit/{id<\d+>}', name: 'student_report_edit')]
    public function edit(Request $request, Report $report, EntityManagerInterface $entityManager, SluggerInterface $slugger, ReportRepository $reportRepository, FileUploader $fileUploader): Response
    {
        $report->setFrontImg('');
        $report->setSideImg('');
        $report->setBackImg('');
        if ($report->getReportAnalysis()) {
            $this->addFlash('error', "Nie możesz edytować sprawdzonego przez trenera raportu!");
            return $this->redirectToRoute('student_reports');
        }
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $imagesReport = [
                'setFrontImg' => $form->get('frontImg')->getData(),
                'setSideImg' => $form->get('sideImg')->getData(),
                'setBackImg' => $form->get('backImg')->getData()
            ];

            $reportsDirectory = $this->getParameter('reports_directory');

            foreach ($imagesReport  as $key => $value) {
                if ($value) {
                    $uploadedFileName = $fileUploader->upload($value, $reportsDirectory);
                    $report->$key($uploadedFileName);
                }
            }

            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $reports = $reportRepository->findMyReports($user->getId());
            $report->setWeightDifference($report->getWeight() - $reports[0]->getWeight());
            $entityManager->persist($report);
            $entityManager->flush();

            $this->addFlash('success', "Raport poprawnie wysłany!");
            return $this->redirectToRoute('student_reports');
        }

        return $this->render('dashboard/student/student_report_edit.html.twig', [
            'form' => $form,
        ]);
    }
}
