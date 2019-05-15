<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DomainsTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreatedDomain()
    {
        $this->post("domains", ['url' => 'http://google.com']);
        $this->seeStatusCode(302);
        $this->seeInDatabase('domains', ['name' => 'http://google.com']);
    }
}