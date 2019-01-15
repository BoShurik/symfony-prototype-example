<?php
/**
 * User: boshurik
 * Date: 2019-01-15
 * Time: 14:10
 */

namespace App\Repository;

use App\Entity\Order;
use App\Order\Model\FilterModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

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
        $this->makeEager($query);

        return $query;
    }

    public function makeEager(Query $query)
    {
        $query->setFetchMode(Order::class, 'user', ClassMetadata::FETCH_EAGER);
        $query->setFetchMode(Order::class, 'currency', ClassMetadata::FETCH_EAGER);
    }

    public function applyFilter(QueryBuilder $builder, FilterModel $filter)
    {
        if ($filter->user) {
            $builder->andWhere('o.user = :user')->setParameter('user', $filter->user);
        }
        if ($filter->currency) {
            $builder->andWhere('o.currency = :currency')->setParameter('currency', $filter->currency);
        }
        if ($filter->message) {
            $builder
                ->andWhere($builder->expr()->like('o.message', ':message'))
                ->setParameter('message', '%' . $filter->message . '%')
            ;
        }
        if ($filter->amountFrom) {
            $builder->andWhere('o.amount >= :amount_from')->setParameter('amount_from', $filter->amountFrom);
        }
        if ($filter->amountTo) {
            $builder->andWhere('o.amount <= :amount_to')->setParameter('amount_to', $filter->amountTo);
        }
        if ($filter->createdAtFrom) {
            $builder->andWhere('o.createdAt >= :created_at_from')->setParameter('created_at_from', $filter->createdAtFrom);
        }
        if ($filter->createdAtTo) {
            $builder->andWhere('o.createdTo <= :created_at_to')->setParameter('created_at_to', $filter->createdAtTo);
        }
    }
}