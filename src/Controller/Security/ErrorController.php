<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ErrorController extends AbstractController
{
    public function showError(): Response
    {
        return $this->render('errors/404.html.twig');
    }
}
