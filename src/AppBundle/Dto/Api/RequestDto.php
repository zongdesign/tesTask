<?php

namespace AppBundle\Dto\Api;

class RequestDto
{
    /**
     * @var string
     */
    public $headers;

    /**
     * @var string
     */
    public $body;

    /**
     * @var string
     */
    public $route;

    /**
     * @var string
     */
    public $method;

    /**
     * @var integer
     */
    public $ip;

    /**
     * @var \DateTime
     */
    public $createdAt;
}