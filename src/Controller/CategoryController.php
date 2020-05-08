<?php


namespace App\Controller;

use App\Services\CategoryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    private $service;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(CategoryService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    /**
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllCategories()
    {
        $data = $this->service->findAll();
        $serialized_data = $this->serializer->serialize($data, 'json');
        return $this->response(json_decode($serialized_data));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $request = $this->transformJsonBody($request);
        $name = $request->get('name');
        $data = $this->service->createCategory($name);
        $serialized_data = $this->serializer->serialize($data, 'json');
        return $this->response(json_decode($serialized_data), Response::HTTP_CREATED);
    }
}