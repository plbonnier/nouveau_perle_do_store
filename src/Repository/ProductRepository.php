<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getAllProductByCategoryAndMaterial(
        int $categoryId,
        int $materialId
    ): array {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.material', 'm')
            ->innerJoin('p.category', 'c')
            ->andWhere('c.id = :categoryId')
            ->andWhere('m.id = :materialId')
            ->setParameter('categoryId', $categoryId)
            ->setParameter('materialId', $materialId)
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
