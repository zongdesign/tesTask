<?php

namespace AppBundle\Services;

use AppBundle\Dto\Api\RequestQueryDto;
use AppBundle\Dto\Domain\RequestQuery;
use AppBundle\Entity\RequestEntity;
use Doctrine\ORM\EntityManagerInterface;

class RequestFinderService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param RequestQueryDto $requestQueryDto
     * @return array
     */
    public function find(RequestQueryDto $requestQueryDto)
    {
        $requestQuery = new RequestQuery();
        $requestQuery->ip       = $requestQueryDto->ip;
        $requestQuery->id       = $requestQueryDto->id;
        $requestQuery->route    = $requestQueryDto->route;
        $requestQuery->method   = $requestQueryDto->method;
        $requestQuery->search   = $requestQueryDto->search;
        $requestQuery->lastDays = $requestQueryDto->lastDays;

        return $this->em->getRepository(RequestEntity::class)->findByParams($requestQuery);
    }
}