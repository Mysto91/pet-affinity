<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ApiTestCaseSimple extends ApiTestCase
{
    protected static function request($method, $uri, $params = [])
    {
        return self::createClient()->request($method, $uri, $params);
    }

    protected static function get($uri, $params = [])
    {
        return self::request('GET', $uri, $params);
    }

    protected static function post($uri, $params = [])
    {
        return self::request('POST', $uri, $params);
    }

    protected static function put($uri, $params = [])
    {
        return self::request('PUT', $uri, $params);
    }

    protected static function delete($uri, $params = [])
    {
        return self::request('DELETE', $uri, $params);
    }
}
