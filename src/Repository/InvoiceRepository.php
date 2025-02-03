<?php

namespace App\Repository;

use App\Entity\Invoice;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Invoice>
 */
class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function findLastNumInvoice(): int
    {
        $result = $this->createQueryBuilder('i')
            ->select('i.numInvoice')
            ->orderBy('i.numInvoice', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $result ? $result['numInvoice'] : 911;
    }

    public function findAllOrderByNulDesc(): array
    {
        return $this->createQueryBuilder('i')
            ->orderBy('i.numInvoice', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByDate(DateTime $date): array
    {
        $start = $date->format('Y-m-d 00:00:00');
        $end = $date->format('Y-m-d 23:59:59');

        return $this->createQueryBuilder('i')
            ->where('i.date BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }

    public function findByMonth(DateTime $start, DateTime $end): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.date BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }

    public function findByYear(DateTime $start, DateTime $end): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.date BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }
}
