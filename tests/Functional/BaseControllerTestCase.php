<?php

namespace App\Tests\Functional;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseControllerTestCase extends WebTestCase
{

    /**
     * @var KernelBrowser
     */
    protected $client;
    /**
     * @var
     */
    private $manager;
    /**
     * @var ORMExecutor
     */
    private $executor;

    protected function setUp()
    {
        $this->client = static::createClient();

        $this->manager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->executor = new ORMExecutor($this->manager, new ORMPurger());

        // Run the schema update tool using our entity metadata
        $schemaTool = new SchemaTool($this->manager);
        $schemaTool->updateSchema($this->manager->getMetadataFactory()->getAllMetadata());


    }

    protected function loadFixture($fixture)
    {
        $loader = new Loader();
        $fixtures = is_array($fixture) ? $fixture : [$fixture];
        foreach ($fixtures as $item) {
            $loader->addFixture($item);
        }
        $this->executor->execute($loader->getFixtures());
    }

    protected function tearDown()
    {
        parent::tearDown();

        (new SchemaTool($this->manager))->dropDatabase();

        // doing this is recommended to avoid memory leaks
        $this->manager->close();
        $this->manager = null;
    }

}
