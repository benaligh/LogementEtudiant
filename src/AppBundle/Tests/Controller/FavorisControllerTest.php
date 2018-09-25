<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FavorisControllerTest extends WebTestCase
{
    public function testListfavoris()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listfavoris');
    }

    public function testDeletefavoris()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/DeleteFavoris');
    }

    public function testShowfavoris()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ShowFavoris');
    }

    public function testAddfavoris()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AddFavoris');
    }

}
