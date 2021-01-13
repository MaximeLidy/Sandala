<?php

namespace App\Service;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;

class UrlGeneratorService
{

    private EntityManagerInterface $entityManager;
    private string $url;

    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;

        do{
            $this->url = md5(uniqid(''));
            $messageRepo = $this->entityManager->getRepository(Message::class)->findOneBy(['url' => $this->url]);
        } while($messageRepo != null);

    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

}