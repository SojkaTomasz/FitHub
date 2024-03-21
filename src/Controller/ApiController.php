<?php
// src/Controller/ApiController.php

namespace App\Controller;

use App\Entity\Report;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
 
    #[Route('/dashboard/api/weight', name: 'reports')]
    public function getWeightData(EntityManagerInterface $entityManager)
    {
       
    }
}