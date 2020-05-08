<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Category;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActivityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('World wide');


        $event = new Event();
        $event->setCategory($category);
        $event->setTitle('Event 1');
        $event->setCreatedAt(new DateTime('now'));

        $event2 = new Event();
        $event2->setCategory($category);
        $event2->setTitle('Event 2');
        $event2->setCreatedAt(new DateTime('now'));

        $manager->persist($category);
        $manager->persist($event);
        $manager->persist($event2);

        $manager->flush();
    }
}
