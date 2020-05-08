<?php

namespace App\Tests\FunctionalTests;

use Symfony\Component\HttpFoundation\Response;

class CategoryControllerTestCase extends BaseControllerTestCase
{
    /**
     * @test
     */
    public function get_all_categories()
    {
        $this->client->request('GET', '/api/categories');

        $response = $this->client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
