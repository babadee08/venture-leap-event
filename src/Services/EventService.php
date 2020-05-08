<?php


namespace App\Services;


use App\Entity\Activity;
use App\Entity\Category;
use App\Repository\ActivityRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class EventService
{

    /**
     * @var ActivityRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ActivityRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @param string $title
     * @param int $category_id
     * @return Activity
     * @throws Exception
     */
    public function createEvent(string $title, int $category_id)
    {
        $event = new Activity();

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
     * @return Activity[]
     */
    public function findAll(int $size = 10)
    {
        return $this->repository->findLatestActivities($size);
    }
}