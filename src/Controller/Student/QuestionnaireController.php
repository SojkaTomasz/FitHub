<?php

namespace App\Controller\Student;

use App\Entity\Questionnaire;
use App\Form\QuestionnaireType;
use App\Service\InfoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\VarDumper\Cloner\Data;

#[IsGranted('ROLE_STUDENT')]
class QuestionnaireController extends AbstractController
{
    #[Route('/dashboard/student/questionnaire/add', name: 'student_questionnaire_add')]
    public function questionnaireAdd(Request $request, EntityManagerInterface $entityManager, InfoService $infoService): Response
    {
        /** @var \App\Entity\User $student */
        $student = $this->getUser();

        if ($student->getQuestionnaire()) {
            $this->addFlash('error', "Nie możesz dodać kolejnej ankiety, możesz edytować aktualną w ustawieniach profilu.");
            return $this->redirectToRoute('student_reports');
        }

        $questionnaire = new Questionnaire();
        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);
        $infoService->closeInfoQuestionnaire($student->getInfos());
        if ($form->isSubmitted() && $form->isValid()) {
            $questionnaire->setUser($student);
            $questionnaire->setCreatedAt(new \DateTimeImmutable());
            $infoService->newInfo("questionnaire-trainer", $student->getTrainer(), $questionnaire);
            $entityManager->persist($questionnaire);
            $entityManager->flush();
            $this->addFlash('success', "Ankieta poprawnie wypełniona");
            return $this->redirectToRoute('student_reports');
        }

        return $this->render('dashboard/student/questionnaire_add.html.twig', [
            'form' => $form,
        ]);
    }
}
