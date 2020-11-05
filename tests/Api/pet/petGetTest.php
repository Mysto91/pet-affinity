<?php

namespace App\Api\Pet\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;

class petGetTest extends ApiTestCase
{
    public function testIfGetByIdWork()
    {
        $petId = 1;

        $response = static::createClient()->request('GET', '/apip/pets/' . $petId)->toArray();
        
        $this->assertEquals($petId, $response['id']);
    }
}
