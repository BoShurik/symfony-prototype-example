<?php
/**
 * User: boshurik
 * Date: 2019-01-15
 * Time: 14:10
 */

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping\ClassMetadata;

class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function getQueryBuilder()
    {
        $builder = $this->createQueryBuilder('o');
        $builder->orderBy('o.createdAt', 'DESC');

        return $builder;
    }

    public function getEagerQuery()
    {
        $builder = $this->getQueryBuilder();

        $query = $builder->getQuery();
        $query->setFetchMode(Order::class, 'user', ClassMetadata::FETCH_EAGER);
        $query->setFetchMode(Order::class, 'currency', ClassMetadata::FETCH_EAGER);

        return $query;
    }
}