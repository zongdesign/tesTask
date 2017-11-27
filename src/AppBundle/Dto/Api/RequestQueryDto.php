<?php

namespace AppBundle\Dto\Api;


class RequestQueryDto
{

    /**
     * @var integer
     */
    public $id;
    /**
     * @var string
     */
    public $method;

    /**
     * @var string
     */
    public $search;

    /**
     * @var string
     */
    public $route;

    /**
     * @var integer
     */
    public $ip;

    /**
     * @var integer
     */
    public $lastDays;
}