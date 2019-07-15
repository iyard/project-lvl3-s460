<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Post;

class DomainsTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore()
    {
        $this->post(route('domains.store'), ['url' => 'https://github.com']);
        $this->seeStatusCode(302);
        $this->seeInDatabase('domains', ['name' => 'https://github.com',
                                         'h1' => 'Built for developers',
                                         'description' => 'GitHub brings together the world’s largest community of developers to discover, share, and build better software. From open source projects to private team repositories, we’re your all-in-one platform for collaborative development.',
                                         'keywords' => '']);
    }

    public function testIndex()
    {
        $this->get(route('domains.index'));
        $this->seeStatusCode(200);

    }

    public function testShow()
    {
        $this->post(route('domains.store'), ['url' => 'https://github.com']);
        $this->get(route('domains.show', ['id' => 1]));
        $this->seeInDatabase('domains', ['name' => 'https://github.com',
                                         'h1' => 'Built for developers',
                                         'description' => 'GitHub brings together the world’s largest community of developers to discover, share, and build better software. From open source projects to private team repositories, we’re your all-in-one platform for collaborative development.',
                                         'keywords' => '']);
    }

}