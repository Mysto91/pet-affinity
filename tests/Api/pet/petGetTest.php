<?php

namespace App\Api\Pet\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;
use App\Tests\Api\ApiTestCaseSimple;

class petGetTest extends ApiTestCaseSimple
{
    public $uri = '/apip/pets';

    public function getUrl($id)
    {
        return $this->uri . '/' . $id;
    }

    public function testIfGetByIdWork()
    {
        $petId = 1;

        $response = self::get($this->getUrl($petId))->toArray();
        
        $this->assertEquals($petId, $response['id']);
        $this->assertResponseStatusCodeSame(200);
    }

    public function testIfGetByIdWithWrongIdNotWork()
    {
        $petId = '999999';

        $response = self::get($this->getUrl($petId));

        $message = json_decode($response->getContent(false), true);

        $this->assertEquals($message['description'],'The pet does not exist');
        $this->assertEquals($message['code'], 404);
        $this->assertResponseStatusCodeSame(404);
    }
}
