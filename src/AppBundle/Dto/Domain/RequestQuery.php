<?php

namespace AppBundle\Dto\Domain;

class RequestQuery
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