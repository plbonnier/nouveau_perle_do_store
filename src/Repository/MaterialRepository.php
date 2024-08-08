<?php

namespace App\Repository;

use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Material>
 */
class MaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Material::class);
    }

    public function getAllMaterialByCategory(int $categoryId): array
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('m.products', 'p')
            ->innerJoin('p.category', 'c')
            ->andWhere('c.id = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
