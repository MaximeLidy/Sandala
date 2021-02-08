<?php


namespace App\Service;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;

class CleanMessagesService
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;

        $messageRepo = $this->entityManager->getRepository(Message::class)->findExpiredMessages();

        foreach ($messageRepo as $message){
            $entityManager->remove($message);
            $entityManager->flush();
        }
    }
}