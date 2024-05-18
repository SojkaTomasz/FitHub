<?php

namespace App\Controller\Student;

use App\Entity\Reviews;
use App\Entity\User;
use App\Form\ReviewsType;
use App\Repository\UserRepository;
use App\Service\InfoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'myTrainer' => $myTrainer ?? false
        ]);
    }

    #[Route('/dashboard/student/trainer/{id}', name: 'student_trainer')]
    public function trainer(?User $trainer, Request $request, EntityManagerInterface $entityManager): Response
    {

        /** @var App\Entity\User $student*/
        $student = $this->getUser();

        if (!$trainer || !in_array("ROLE_TRAINER", $trainer->getRoles())) {
            $this->addFlash('error', "Nie znaleziono trenera!");
            return $this->redirectToRoute('all_trainers');
        }

        if ($trainer->getStudents()->contains($student)) {
            $review = new Reviews();
            $form = $this->createForm(ReviewsType::class, $review);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $review->setTrainer($trainer);
                $review->setDate(new \DateTime());
                $entityManager->persist($review);
                $entityManager->flush();

                $this->addFlash('success', "Opinia dodana!");
                return $this->redirectToRoute('student_trainer', ['id' => $trainer->getId()]);
            }
        }
        return $this->render('dashboard/student/trainer.html.twig', [
            'trainer' => $trainer,
            'form' => $form ?? false
        ]);
    }

    #[Route('/dashboard/student/chose/trainer/{id<\d+>}', name: 'chose_trainer')]
    public function add(EntityManagerInterface $entityManager, ?User $trainer, InfoService $infoService): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if ($user->getTrainer()) {
            $this->addFlash('error', "Pierwsze zakończ współpracę z {$user->getTrainer()->getFirstName()}");
            return $this->redirectToRoute('all_trainers');
        }

        $user->setTrainer($trainer);
        $entityManager->persist($user);
        $infoService->newInfo("new-student", $trainer, $user);
        $entityManager->flush();
        $this->addFlash('success', "Wybrałeś użytkownika {$trainer->getFirstName()}");

        return $this->redirectToRoute('all_trainers');
    }
}
