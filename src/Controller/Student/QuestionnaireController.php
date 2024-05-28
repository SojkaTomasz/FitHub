<?php

namespace App\Controller\Student;

use App\Entity\Questionnaire;
use App\Form\QuestionnaireType;
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
    public function questionnaireAdd(Request $request, EntityManagerInterface $entityManager,): Response
    {
        $questionnaire = new Questionnaire();
        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var \App\Entity\User $user */
            $user = $this->getUser();

            $questionnaire->setUser($user);
            $questionnaire->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($questionnaire);
            $entityManager->flush();

            $this->addFlash('success', "Ankieta poprawnie wypełniona");
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('dashboard/student/questionnaire_add.html.twig', [
            'form' => $form,
        ]);
    }
}
