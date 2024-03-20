<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SettingsController extends AbstractController
{
    #[Route('dashboard/settings', name: 'settings')]
    public function settingsTrainer(): Response
    {
        return $this->render('dashboard/settings.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
