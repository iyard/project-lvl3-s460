<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Controllers\DomainsController;
use App\Post;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class DomainsTest extends TestCase
{
    use DatabaseTransactions;

    public function testStore()
    {
        $mockGuzzle = new MockHandler([
            new Response(200, ['Content-Length' => 0,
                                'body' => '<h1>Tag</h1>',
                                'description' => 'description GitHub',
                                'keywords' => 'keywords GitHub']),
            new Response(200, ['body' => '<h1>Tag</h1>',
                               'description' => 'description GitHub',
                               'keywords' => 'keywords GitHub'])
        ]);
        $handler = HandlerStack::create($mockGuzzle);
        $guzzle = new Client(['handler' => $handler]);

        $this->app->instance(Client::class, $guzzle);
        
        $this->post(route('domains.store'), ['url' => 'https://github.com']);
        $this->seeStatusCode(302);
        $this->seeInDatabase('domains', ['name' => 'https://github.com']);
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