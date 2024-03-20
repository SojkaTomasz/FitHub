<?php

namespace App\Controller\Student;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TrainersController extends AbstractController
{
    #[Route('/dashboard/student/trainers', name: 'trainers_all')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $trainers = $entityManager->getRepository(User::class)->findByTrainer();
        return $this->render('dashboard/student/trainers.html.twig', [
            'trainers' => $trainers,
        ]);
    }

    #[Route('/dashboard/student/chose/trainer/{id}', name: 'chose_trainer')]
    public function add(EntityManagerInterface $entityManager, User $trainer): Response
    {
        $currentUser = $this->getUser();
        if ($currentUser->getTrainer()) {
            $this->addFlash('error', "Pierwsze zakończ współpracę z {$currentUser->getTrainer()->getFirstName()}");
        } else {
            $currentUser->setTrainer($trainer);

            $entityManager->persist($currentUser);
            $entityManager->flush();

            $this->addFlash('success', "Wybrałeś użytkownika {$trainer->getFirstName()}");
        }

        return $this->redirectToRoute('trainers_all');
    }
}
