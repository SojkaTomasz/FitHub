<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccessDeniedController extends AbstractController
{
    #[Route('/dashboard/access-denied', name: 'access_denied')]
    public function index(): Response
    {
        return $this->render('security/access_denied.html.twig');
    }
}
