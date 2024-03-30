<?php

namespace App\Controller\Student;

use App\Entity\Report;
use App\Entity\ReportAnalysis;
use App\Form\ReportType;
use App\Repository\ReportRepository;
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
    public function report(EntityManagerInterface $entityManager, ?Report $id, ReportRepository $reportRepository): Response
    {

        /** @var \App\Entity\User $student */
        $student = $this->getUser();

        if (!$id) {
            $this->addFlash('error', "Nie ma takiego raportu!");
            return $this->redirectToRoute('student_reports');
        }

        $report = $entityManager->getRepository(Report::class)->find($id);

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
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, ReportRepository $reportRepository): Response
    {
        $report = new Report();
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $frontImg = $form->get('frontImg')->getData();
            $sideImg = $form->get('sideImg')->getData();
            $backImg = $form->get('backImg')->getData();

            $imagesReport = ['setFrontImg' => $frontImg, 'setSideImg' => $sideImg, 'setBackImg' => $backImg];

            foreach ($imagesReport  as $key => $value) {
                if ($value) {
                    $originalFileName = pathinfo($value->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFileName);
                    $newFileName = $safeFilename . '-' . uniqid() . '.' . $value->guessExtension();
                    $report->$key($newFileName);
                    $value->move(
                        $this->getParameter('reports_directory'),
                        $newFileName
                    );
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
}
