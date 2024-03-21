<?php

namespace App\Controller\Student;

use App\Entity\Report;
use App\Form\ReportType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ReportController extends AbstractController
{
    #[Route('/dashboard/student/reports', name: 'reports')]
    public function reports(EntityManagerInterface $entityManager): Response
    {
        $reports = $entityManager->getRepository(Report::class)->findAll();

        return $this->render('dashboard/student/reports.html.twig', [
            'reports' => $reports,
        ]);
    }

    #[Route('/dashboard/student/report/add', name: 'report-add')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
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
            $report->setDate(new \DateTime());
            $report->setStudent($this->getUser());
            $entityManager->persist($report);
            $entityManager->flush();

            $this->addFlash('success', "Raport poprawnie wysłany!");
            return $this->redirectToRoute('reports');
        }

        return $this->render('dashboard/student/report-add.html.twig', [
            'form' => $form,
        ]);
    }
}
