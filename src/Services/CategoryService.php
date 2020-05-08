<?php


namespace App\Services;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(CategoryRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function createCategory(string $name)
    {
        $category = new Category();
        $category->setName($name);
        $this->manager->persist($category);
        $this->manager->flush();

        return $category;
    }
}