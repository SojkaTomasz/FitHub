<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserAvatarType;
use App\Form\UserDescriptionType;
use App\Form\UserEmailType;
use App\Form\UserPasswordType;
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
    public function settings(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $formPassword = $this->createForm(UserPasswordType::class, $user);
        $formPassword->handleRequest($request);

        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "Poprawnie zaktualizowałeś hasło!");
            return $this->redirectToRoute('settings');
        }

        $formDescription = $this->createForm(UserDescriptionType::class, $user);
        $formDescription->handleRequest($request);

        if ($formDescription->isSubmitted() && $formDescription->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "Poprawnie zaktualizowałeś opis!");
            return $this->redirectToRoute('settings');
        }

        $formEmail = $this->createForm(UserEmailType::class, $user);
        $formEmail->handleRequest($request);

        if ($formEmail->isSubmitted() && $formEmail->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "Poprawnie zaktualizowałeś email!");
            return $this->redirectToRoute('settings');
        }

        $user->setAvatar('');
        $formAvatar = $this->createForm(UserAvatarType::class, $user);
        $formAvatar->handleRequest($request);
        if ($formAvatar->isSubmitted() && $formAvatar->isValid()) {
            $avatar = $formAvatar->get('avatar')->getData();
            $avatarDirectory = $this->getParameter('avatar_directory');
            $uploadedFileName = $fileUploader->upload($avatar, $avatarDirectory);
            $user->setAvatar($uploadedFileName);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "Poprawnie zaktualizowałeś avatar!");
            return $this->redirectToRoute('settings');
        }

        return $this->render('dashboard/settings/settings.html.twig', [
            'formPassword' => $formPassword,
            'formDescription' => $formDescription,
            'formEmail' => $formEmail,
            'formAvatar' => $formAvatar,
        ]);
    }
}
