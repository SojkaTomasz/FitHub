<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function dashboardTrainer(ChartBuilderInterface $chartBuilder): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $reports = $user->getReportsStudent();

        $chartWeight = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chartCircuits = $chartBuilder->createChart(Chart::TYPE_LINE);

        $date = [];
        $weight = [];
        $calfCircumference = [];
        $thighCircumference = [];
        $beltCircumference = [];
        $chestCircumference = [];
        $neckCircumference = [];
        $bicepsCircumference = [];

        foreach ($reports as $report) {
            $date[] = $report->getDate()->format('y-M-d');

            $weight['label'] = "Waga";
            $weight['backgroundColor'] = 'rgb(255, 99, 132, .4)';
            $weight['borderColor'] = 'rgb(255, 99, 132)';
            $weight['data'][] = $report->getWeight();
            $weight['tension'] = 0.4;

            $calfCircumference['label'] = "Łydka";
            $calfCircumference['backgroundColor'] = '#ff97ac';
            $calfCircumference['borderColor'] = '#ff4a70';
            $calfCircumference['data'][] = $report->getCalfCircumference();
            $calfCircumference['tension'] = 0.4;

            $thighCircumference['label'] = "Udo";
            $thighCircumference['backgroundColor'] = '#ffa37d';
            $thighCircumference['borderColor'] = '#ff6d31';
            $thighCircumference['data'][] = $report->getThighCircumference();
            $calfCircumference['tension'] = 0.4;

            $beltCircumference['label'] = "Pas";
            $beltCircumference['backgroundColor'] = '#7dd9ff';
            $beltCircumference['borderColor'] = '#4acaff';
            $beltCircumference['data'][] = $report->getBeltCircumference();
            $beltCircumference['tension'] = 0.4;

            $chestCircumference['label'] = "Klatka";
            $chestCircumference['backgroundColor'] = '#b9ff7d';
            $chestCircumference['borderColor'] = '#90ff31';
            $chestCircumference['data'][] = $report->getChestCircumference();
            $chestCircumference['tension'] = 0.4;

            $neckCircumference['label'] = "Szyja";
            $neckCircumference['backgroundColor'] = '#c37dff';
            $neckCircumference['borderColor'] = '#ab4aff';
            $neckCircumference['data'][] = $report->getNeckCircumference();
            $neckCircumference['tension'] = 0.4;

            $bicepsCircumference['label'] = "Biceps";
            $bicepsCircumference['backgroundColor'] = '#827dff';
            $bicepsCircumference['borderColor'] = '#514aff';
            $bicepsCircumference['data'][] = $report->getBicepsCircumference();
            $bicepsCircumference['tension'] = 0.4;

            $forearmCircumference['label'] = "Przedramie";
            $forearmCircumference['backgroundColor'] = '#fcffb0';
            $forearmCircumference['borderColor'] = '#f8ff4a';
            $forearmCircumference['data'][] = $report->getForearmCircumference();
            $forearmCircumference['tension'] = 0.4;
        }


        $chartWeight->setData([
            'labels' => $date,
            'datasets' => [
                $weight
            ],
        ]);

        $chartCircuits->setData([
            'labels' => $date,
            'datasets' => [
                $calfCircumference,
                $thighCircumference,
                $beltCircumference,
                $chestCircumference,
                $neckCircumference,
                $bicepsCircumference,
                $forearmCircumference,
            ],
        ]);

        $chartWeight->setOptions([
            'maintainAspectRatio' => false,
        ]);
        $chartCircuits->setOptions([
            'maintainAspectRatio' => false,
        ]);

        return $this->render('dashboard/home.html.twig', [
            'chartWeight' => $chartWeight,
            'chartCircuits' => $chartCircuits,
        ]);
    }
}
