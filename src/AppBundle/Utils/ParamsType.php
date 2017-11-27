<?php

namespace AppBundle\Utils;

class ParamsType
{
    const ID        = 'id';
    const IP        = 'ip';
    const ROUTE     = 'route';
    const METHOD    = 'method';
    const LAST_DAYS = 'last_days';
    const SEARCH    = 'search';

    const METHOD_POST = 'post';
    const METHOD_GET  = 'get';

    /**
     * @return array
     */
    public static function all()
    {
        return [
            self::ID,
            self::IP,
            self::ROUTE,
            self::METHOD,
            self::LAST_DAYS,
            self::SEARCH,
        ];
    }

    /**
     * @return array
     */
    public static function methods()
    {
        return [
            self::METHOD_POST,
            self::METHOD_GET,
        ];
    }
}