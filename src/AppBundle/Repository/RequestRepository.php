<?php

namespace AppBundle\Repository;

use AppBundle\Dto\Domain\RequestQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class RequestRepository extends EntityRepository
{
    public function findByParams(RequestQuery $requestQuery)
    {
        $qb = $this->createQueryBuilder('r');

        $this->addIdCriteria($qb, $requestQuery->id);
        $this->addIpCriteria($qb, $requestQuery->ip);
        $this->addRouteCriteria($qb, $requestQuery->route);
        $this->addMethodCriteria($qb, $requestQuery->method);
        $this->addSearchCriteria($qb, $requestQuery->search);
        $this->addLastDaysCriteria($qb, $requestQuery->lastDays);

        return $qb->getQuery()->getArrayResult();
    }

    protected function addMethodCriteria(QueryBuilder $qb, $method)
    {
        if ($method) {
            $qb
                ->andWhere('r.method = :method')
                ->setParameter('method', $method)
            ;
        }
    }

    protected function addIpCriteria(QueryBuilder $qb, $ip)
    {
        if ($ip) {
            $qb
                ->andWhere('INET_ATON(r.ip) = INET_ATON(:ip)')
                ->setParameter('ip', $ip)
            ;
        }
    }

    protected function addIdCriteria(QueryBuilder $qb, $id)
    {
        if ($id) {
            $qb
                ->andWhere('r.id = :id')
                ->setParameter('id', $id)
            ;
        }
    }

    protected function addRouteCriteria(QueryBuilder $qb, $route)
    {
        if ($route) {
            $qb
                ->andWhere('r.route = :route')
                ->setParameter('route', $route)
            ;
        }
    }

    protected function addSearchCriteria(QueryBuilder $qb, $search)
    {
        if ($search) {
            $qb
                ->andWhere('r.body LIKE :search OR r.headers LIKE :search' )
                ->setParameter('search', '%'.$search.'%')
            ;
        }
    }

    protected function addLastDaysCriteria(QueryBuilder $qb, $lastDays)
    {
        if ($lastDays) {
            $date = new \DateTime();
            $qb
                ->andWhere('r.createdAt > :date' )
                ->setParameter('date', $date->modify('-'.$lastDays.' day'));
            ;
        }
    }

}
