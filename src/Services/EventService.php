<?php


namespace App\Services;


use App\Entity\Event;
use App\Entity\Category;
use App\Repository\EventRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class EventService
{

    /**
     * @var EventRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * EventService constructor.
     * @param EventRepository $repository
     * @param EntityManagerInterface $manager
     */
    public function __construct(EventRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @param string $title
     * @param int $category_id
     * @return Event
     * @throws Exception
     */
    public function createEvent(string $title, int $category_id)
    {
        $event = new Event();

        $category = $this->manager->getRepository(Category::class)->find($category_id);

        if ($category === null) {
            throw new Exception( "Invalid Category provided" );
        }
        $event->setCategory($category);
        $event->setTitle($title);
        $event->setCreatedAt(new DateTime('now'));

        $this->manager->persist($event);
        $this->manager->flush();

        return $event;

    }

    /**
     * @param int $size
     * @return Event[]
     */
    public function findAll(int $size = 10)
    {
        return $this->repository->findLatestActivities($size);
    }
}