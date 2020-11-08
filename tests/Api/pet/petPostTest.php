<?php

namespace App\Api\Pet\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;
use App\Tests\Api\ApiTestCaseSimple;

class petPostTest extends ApiTestCaseSimple
{
    public $uri = '/apip/pets';

    public function getUrl()
    {
        return $this->uri;
    }

    public function testIfPostByIdWork()
    {
        $body = [
            'Name' => 'Neige',
            'type' => 'cat',
            'Description' => 'Chat timide',
            'gender' => 'male',
            'color' => 'black',
            'size' => 80,
            'age' => 1
        ];

        $response = self::post($this->getUrl(), ['json' => $body])->toArray();

        $this->assertEquals($body['Name'], $response['Name']);
        $this->assertResponseStatusCodeSame(201);
    }

    public function testIfPostWithoutBodyNotWork()
    {
        $response = self::post($this->getUrl(), ['json' => []]);

        $message = json_decode($response->getContent(false), true);

        $this->assertResponseStatusCodeSame(400);
    }
}
