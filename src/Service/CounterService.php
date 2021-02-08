<?php


namespace App\Service;


use App\Entity\Stats;
use Doctrine\ORM\EntityManagerInterface;

class CounterService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, $type)
    {
        $this->entityManager = $entityManager;
        $stats = $this->entityManager->getRepository(Stats::class)->findOneBy(['id' => 1]);

        //Init
        if(is_null($stats)){
            $newCounter = new Stats(0,0,0,0);
            $entityManager->persist($newCounter);
            $entityManager->flush();
        }

        $stats->setCounter($stats->getCounter() + 1);

        switch ($type) {
            case "code":
                $stats->setCodeCount($stats->getCodeCount() + 1);
                break;
            case "letter":
                $stats->setLetterCount($stats->getLetterCount() + 1);
                break;
            case "note":
                $stats->setNoteCount($stats->getNoteCount() + 1);
                break;
        }

        $entityManager->persist($stats);
        $entityManager->flush();
    }
}