<?php

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseControllerTestCase extends WebTestCase
{

    /**
     * @var KernelBrowser
     */
    protected $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

}
