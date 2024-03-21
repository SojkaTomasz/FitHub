<?php

namespace App\Controller;

use App\Entity\Report;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function dashboardTrainer(EntityManagerInterface $entityManager): Response
    {
        $reports = $entityManager->getRepository(Report::class)->findAll();

        $reportsArray = [];
        foreach ($reports as $report) {
            $reportsArray[] = [
                // 'weight' => $report->getWeight(),
                'date' => $report->getDate(),
                'calfCircumference' => $report->getCalfCircumference(),
                'thighCircumference' => $report->getThighCircumference(),
                'beltCircumference' => $report->getBeltCircumference(),
                'chestCircumference' => $report->getChestCircumference(),
                'neckCircumference' => $report->getNeckCircumference(),
                'bicepsCircumference' => $report->getBicepsCircumference(),
                'forearmCircumference' => $report->getForearmCircumference(),
                'percentDiet' => $report->getPercentDiet(),
                // 'frontImg' => $report->getFrontImg(),
                // 'sideImg' => $report->getSideImg(),
                // 'backImg' => $report->getBackImg(),
            ];
        }

        return $this->render('dashboard/index.html.twig', [
            'weightData' => $reportsArray,
        ]);
    }
}
