<?php


namespace App\Core\Orm;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template E of object
 *
 * @method E|null find($id, $lockMode = null, $lockVersion = null)
 * @method E|null findOneBy(array $criteria, array $orderBy = null)
 * @method E[]    findAll()
 * @method E[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param class-string<E> $entityClass
     * @psalm-param class-string<E> $entityClass
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }
}