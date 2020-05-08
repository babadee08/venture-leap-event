<?php

namespace App\Tests\Functional;

use App\DataFixtures\CategoryFixtures;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;

class CategoryControllerTest extends BaseControllerTestCase
{
    /**
     * @test
     */
    public function get_all_categories()
    {
        $this->loadFixture(new CategoryFixtures());

        $this->client->request('GET', '/api/categories');

        $response = $this->client->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($response->getContent(), json_encode([
            ['id' => 1, 'name' => 'Worldwide'],
            ['id' => 2, 'name' => 'CountryWide'],
        ]));
    }

    /**
     * @test
     */
    public function it_can_create_new_category()
    {
        $this->loadFixture(new CategoryFixtures());
        $this->client->request('POST', '/api/categories', [], [], [], json_encode([
            'name' => 'StateWide'
        ]));

        $response = $this->client->getResponse();
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        $em = self::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        /** @var Category $product */
        $product = $em->getRepository(Category::class)->find(3);
        $this->assertEquals('StateWide', $product->getName());
    }
}
