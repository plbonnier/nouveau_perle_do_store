<?php

namespace App\Repository;

use App\Entity\Invoice;
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

        return $result ? $result['numInvoice'] : 555;
    }

    public function findAllOrderByNulDesc(): array
    {
        return $this->createQueryBuilder('i')
            ->orderBy('i.numInvoice', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
