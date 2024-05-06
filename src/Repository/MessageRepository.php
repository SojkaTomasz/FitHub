<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\When;

/**
 * @extends ServiceEntityRepository<Message>
 *
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function findAllMessage($sender, $recipient): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.sender = :user1 AND m.recipient = :user2')
            ->orWhere('m.sender = :user2 AND m.recipient = :user1')
            ->setParameter('user1', $recipient)
            ->setParameter('user2', $sender)
            ->orderBy('m.createdAt', 'ASC')
            ->getQuery()
            ->execute();
    }

    public function countMessagesPerSender($recipientId)
    {
        return $this->createQueryBuilder('m')
            ->orWhere('m.sender = :recipientId')
            ->orWhere('m.recipient = :recipientId')
            ->setParameter('recipientId', $recipientId)
            ->groupBy('m.sender,m.recipient')
            ->orderBy("m.createdAt", "DESC")
            ->getQuery()
            ->getResult();
    }
}
