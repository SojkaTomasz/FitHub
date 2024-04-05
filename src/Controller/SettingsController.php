<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SettingsController extends AbstractController
{
    #[Route('/dashboard/settings', name: 'settings')]
    public function settings(): Response
    {
        return $this->render('dashboard/settings.html.twig');
    }

    #[Route('/dashboard/settings/edit', name: 'settings_edit')]
    public function settingsEdit(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $user->setAvatar('');
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $avatar = $form->get('avatar')->getData();
            $avatarDirectory = $this->getParameter('avatar_directory');
            $uploadedFileName = $fileUploader->upload($avatar, $avatarDirectory);
            $user->setAvatar($uploadedFileName);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', "Poprawnie zaktualizowałeś dane!");
            return $this->redirectToRoute('settings');
        }

        return $this->render('dashboard/settings_edit.html.twig', [
            'form' => $form
        ]);
    }
}
