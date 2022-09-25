<?php

namespace App\Repository;

use App\Entity\ProductTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductTranslation>
 *
 * @method ProductTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductTranslation[]    findAll()
 * @method ProductTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductTranslation::class);
    }

}
