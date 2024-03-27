<?php

namespace App\Controller\Trainer;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentsController extends AbstractController
{
    #[Route('/dashboard/trainer/students', name: 'students-trainer_all')]
    public function index(UserRepository $userRepository): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $students = $userRepository->findMyStudents($user->getId());
        return $this->render('dashboard/trainer/students.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/dashboard/trainer/student/termination/{id}', name: 'student_termination')]
    public function remove(EntityManagerInterface $entityManager, User $user): Response
    {
        $user->setTrainer(null);
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('students-trainer_all');
    }
}
