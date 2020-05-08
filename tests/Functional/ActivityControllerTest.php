<?php

namespace App\Tests\Functional;


use App\DataFixtures\ActivityFixtures;
use App\DataFixtures\CategoryFixtures;
use Symfony\Component\HttpFoundation\Response;

class ActivityControllerTest extends BaseControllerTestCase
{
    /**
     * @test
     */
    public function it_can_create_an_event()
    {
        $this->loadFixture(new CategoryFixtures());

        $this->client->request('POST', '/api/events', [], [], [], json_encode([
            'category_id' => 1,
            'title' => 'Attend a global event'
        ]));

        $response = $this->client->getResponse();
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function it_can_fetch_all_events()
    {
        $this->loadFixture(new ActivityFixtures());

        $this->client->request('GET', '/api/events');

        $response = $this->client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
