<?php

namespace App\Controller\Trainer;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\InfoService;
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
    public function students(UserRepository $userRepository): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $students = $userRepository->findMyStudents($user->getId());
        return $this->render('dashboard/trainer/students.html.twig', [
            'students' => $students,
        ]);
    }

    #[Route('/dashboard/trainer/student/{id<\d+>}', name: 'trainer_student')]
    public function student(UserRepository $userRepository, ?User $student, InfoService $infoService): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$student) {
            $this->addFlash('error', "Nie ma takiego studenta");
            return $this->redirectToRoute('students_trainer_all');
        }

        $students = $userRepository->findMyStudents($user->getId());
        $infoService->closeInfoNewStudent($user->getInfos(), $student);
        $infoQuestionnaire = $student->getQuestionnaire() ? $student->getQuestionnaire()->getInfos() : null;
        $infoService->closeInfo($infoQuestionnaire);

        if (!in_array($student, $students)) {
            throw new AccessDeniedException();
        }

        return $this->render('dashboard/trainer/student.html.twig', [
            'student' => $student,
        ]);
    }

    #[Route('/dashboard/trainer/student/termination/{id<\d+>}', name: 'student_termination')]
    public function remove(EntityManagerInterface $entityManager, ?User $student, InfoService $infoService): Response
    {
        /** @var \App\Entity\User $trainer */
        $trainer = $this->getUser();

        if ($student->getTrainer() !== $trainer) {
            throw new AccessDeniedException();
        }

        $infoService->newInfo("termination", $student, $trainer);

        $student->setTrainer(null);
        $entityManager->persist($student);
        $entityManager->flush();

        $this->addFlash('success', "Poprawnie zakończono współpracę z {$student->getFirstName()} {$student->getLastName()}");
        return $this->redirectToRoute('students_trainer_all');
    }
}
