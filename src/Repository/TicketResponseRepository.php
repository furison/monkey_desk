<?php

namespace App\Repository;

use App\Entity\TicketReply;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Polyfill\Intl\Icu\Exception\NotImplementedException;

/**
 * @extends ServiceEntityRepository<TicketReply>
 *
 * @method TicketReply|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketReply|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketReply[]    findAll()
 * @method TicketReply[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TicketReply::class);
    }

//    /**
//     * @return Ticket[] Returns an array of Ticket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TicketReply
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
