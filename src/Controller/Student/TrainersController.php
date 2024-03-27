<?php

namespace App\Controller\Student;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



class TrainersController extends AbstractController
{
    #[Route('/dashboard/student/trainers', name: 'all_trainers_for_student')]
    public function index(UserRepository $userRepository): Response
    {
        $trainers = $userRepository->findAllTrainers();
        return $this->render('dashboard/student/trainers.html.twig', [
            'trainers' => $trainers,
        ]);
    }

    #[Route('/dashboard/student/chose/trainer/{id}', name: 'chose_trainer')]
    public function add(EntityManagerInterface $entityManager, ?User $trainer): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$trainer) {
            $this->addFlash('error', "Trener o podanym ID nie istnieje!");
            return $this->redirectToRoute('all_trainers_for_student');
        }
        if ($user->getTrainer()) {
            $this->addFlash('error', "Pierwsze zakończ współpracę z {$user->getTrainer()->getFirstName()}");
        } else {
            $user->setTrainer($trainer);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "Wybrałeś użytkownika {$trainer->getFirstName()}");
        }

        return $this->redirectToRoute('all_trainers_for_student');
    }
}
