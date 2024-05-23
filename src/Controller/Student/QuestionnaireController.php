<?php

namespace App\Controller\Student;

use App\Entity\Questionnaire;
use App\Form\QuestionnaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_STUDENT')]
class QuestionnaireController extends AbstractController
{
    #[Route('/dashboard/student/questionnaire/add', name: 'student_questionnaire_add')]
    public function questionnaireAdd(Request $request): Response
    {
        $questionnaire = new Questionnaire();

        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);
        return $this->render('dashboard/student/questionnaire_add.html.twig', [
            'form' => $form,
        ]);
    }
}
