<?php

namespace App\Repository;

use App\Entity\Message;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Type;
use Doctrine\Persistence\ManagerRegistry;

/**
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

    public function findOneByUrl($value): ?Message
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.url = :url')
            ->setParameter('url', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findExpiredMessages()
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.deathDate < :deathDateValue')
            ->setParameter('deathDateValue', new DateTime("NOW"), Type::DATETIME)
            ->getQuery()
            ->getResult();
    }
}
