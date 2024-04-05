<?php

namespace App\Controller\Student;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_STUDENT')]
class StudentsController extends AbstractController
{
    #[Route('/dashboard/student/trainers', name: 'all_trainers')]
    public function trainers(UserRepository $userRepository): Response
    {
        /** @var App\Entity\User $user */

        $user = $this->getUser();
        $myTrainer = $user->getTrainer();
        if ($myTrainer) {
            $trainers = $userRepository->findAllTrainersExceptMine($myTrainer);
        } else {
            $trainers = $userRepository->findAllTrainers();
        }
        return $this->render('dashboard/student/trainers.html.twig', [
            'trainers' => $trainers,
        ]);
    }

    #[Route('/dashboard/student/trainer/{id}', name: 'student_trainer')]
    public function trainer(User $trainer): Response
    {

        return $this->render('dashboard/student/trainer.html.twig', [
            'trainer' => $trainer,
        ]);
    }

    #[Route('/dashboard/student/chose/trainer/{id<\d+>}', name: 'chose_trainer')]
    public function add(EntityManagerInterface $entityManager, ?User $trainer): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if ($user->getTrainer()) {
            $this->addFlash('error', "Pierwsze zakończ współpracę z {$user->getTrainer()->getFirstName()}");
            return $this->redirectToRoute('all_trainers');
        }

        $user->setTrainer($trainer);
        $entityManager->persist($user);
        $entityManager->flush();
        $this->addFlash('success', "Wybrałeś użytkownika {$trainer->getFirstName()}");

        return $this->redirectToRoute('all_trainers');
    }
}
