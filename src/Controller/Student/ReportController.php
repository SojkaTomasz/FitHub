<?php

namespace App\Controller\Student;

use App\Entity\Report;
use App\Form\ReportType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ReportController extends AbstractController
{
    #[Route('/dashboard/student/report', name: 'report')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $report = new Report();
        $form = $this->createForm(ReportType::class, $report);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $report->setDate(new \DateTime());
            $report->setStudent($this->getUser());
            $entityManager->persist($report);
            $entityManager->flush();

            return $this->redirectToRoute('report');
            $this->addFlash('success', "Raport poprawnie wysłany!");
        }

        return $this->render('dashboard/student/report.html.twig', [
            'form' => $form,
        ]);
    }
}
