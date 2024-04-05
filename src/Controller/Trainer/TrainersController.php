<?php

namespace App\Controller\Trainer;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_TRAINER')]
class TrainersController extends AbstractController
{
    #[Route('/dashboard/trainer/students', name: 'students_trainer_all')]
    public function index(UserRepository $userRepository): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $students = $userRepository->findMyStudents($user->getId());
        return $this->render('dashboard/trainer/students.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/dashboard/trainer/student/termination/{id<\d+>}', name: 'student_termination')]
    public function remove(EntityManagerInterface $entityManager, ?User $student): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if ($student->getTrainer() !== $trainer) {
            throw new AccessDeniedException();
        }
        
        $student->setTrainer(null);
        $entityManager->persist($student);
        $entityManager->flush();
        return $this->redirectToRoute('students_trainer_all');
    }
}
