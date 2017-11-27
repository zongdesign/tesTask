<?php

namespace AppBundle\Services;

use AppBundle\Dto\Api\RequestDto;
use AppBundle\Entity\RequestEntity;
use Doctrine\ORM\EntityManagerInterface;

class RequestSaverService
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
     * @param RequestDto $requestDto
     * @return RequestEntity $requestEntity
     */
    public function save(RequestDto $requestDto)
    {
        $requestEntity = new RequestEntity();
        $requestEntity
            ->setBody($requestDto->body)
            ->setHeaders($requestDto->headers)
            ->setIp($requestDto->ip)
            ->setRoute($requestDto->route)
            ->setMethod($requestDto->method)
            ->setCreatedAt($requestDto->createdAt)
        ;

        $this->em->persist($requestEntity);
        $this->em->flush();

        return $requestEntity;
    }


}