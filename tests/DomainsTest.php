<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DomainsTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore()
    {
        $this->post('domains.store', ['url' => 'http://google.com']);
        $this->seeStatusCode(302);
        $this->seeInDatabase('domains', ['name' => 'http://google.com']);
    }

    public function testIndex()
    {
        $this->get('domains.index');

    }

    public function testShow()
    {
        $this->get('domains.show', ['id' => 1]);
        $this->seeStatusCode(302);
    }
}