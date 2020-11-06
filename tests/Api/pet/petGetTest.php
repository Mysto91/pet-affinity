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
        $this->assertResponseStatusCodeSame(200);
    }

    public function testIfGetByIdWithWrongIdNotWork()
    {
        $petId = '999999';

        $response = static::createClient()->request('GET', '/apip/pets/' . $petId);

        $message = json_decode($response->getContent(false), true);

        $this->assertEquals($message['description'],'The pet does not exist');
        $this->assertEquals($message['code'], 404);
        $this->assertResponseStatusCodeSame(404);
    }
}
