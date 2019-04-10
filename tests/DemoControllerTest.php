<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DemoControllerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/say-hello');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Symfony çay génial', $crawler->filter('h1')->text());
    }
}
