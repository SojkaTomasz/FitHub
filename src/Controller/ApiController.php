<?php
// src/Controller/ApiController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/weight", name="api_weight_data")
     */
    public function getWeightData()
    {
        // Sztywne dane o wadze użytkownika
        $weightData = [
            ['date' => '2022-01-01', 'weight' => 70],
            ['date' => '2022-01-08', 'weight' => 69],
            ['date' => '2022-01-15', 'weight' => 40],
            ['date' => '2022-01-22', 'weight' => 67],
            ['date' => '2022-01-29', 'weight' => 50],
        ];

        return $this->render('weight/chart.html.twig', [
            'weightData' => $weightData,
        ]);
    }
}
