<?php

namespace App\Controller\Message;

use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends AbstractController
{
    #[Route('dashboard/message/{id}', name: 'message')]
    public function message(Request $request, EntityManagerInterface $entityManager, ?User $recipient, MessageRepository $messageRepository): Response
    {
        /** @var \App\Entity\User $sender */
        $sender = $this->getUser();

        if (is_null($recipient)) {
            $this->addFlash('error', "Nie ma tekigo użytkownika!");
            return $this->redirectToRoute('student_reports');
        }

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $unreadMessageCountRecipient = $recipient->getUnreadMessageCount();
            $recipient->setUnreadMessageCount($unreadMessageCountRecipient + 1);
            $message->setSender($sender);
            $message->setRecipient($recipient);
            $message->setCreatedAt(new \DateTime());
            $message->setSeen(false);
            $entityManager->persist($message);
            $entityManager->flush();
            return $this->redirectToRoute('message', ['id' => $recipient->getId()]);
        }

        $AllMessages = $messageRepository->findAllMessage($sender, $recipient);

        foreach ($AllMessages as $message) {
            if (!$message->isSeen() and $message->getSender() !== $sender) {
                $message->setSeen(true);
                $unreadMessageCountSender = $sender->getUnreadMessageCount();
                $sender->setUnreadMessageCount($unreadMessageCountSender - 1);
                $entityManager->persist($message);
            }
        }
        $entityManager->flush();

        return $this->render('dashboard/messages/message.html.twig', [
            'form' => $form,
            'messages' => $AllMessages,
            'recipient' => $recipient,
        ]);
    }

    #[Route('dashboard/messages', name: 'messages')]
    public function messages(Request $request, EntityManagerInterface $entityManager, ?User $recipient, MessageRepository $messageRepository): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();


        $AllMessages = $messageRepository->countMessagesPerSender($user);

        return $this->render('dashboard/messages/messages.html.twig', [
            'messages' => $AllMessages,
        ]);
    }
}
