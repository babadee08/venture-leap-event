<?php


namespace App\Controller;


use App\Services\EventService;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class EventsController extends BaseController
{
    /**
     * @var EventService
     */
    private $service;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * EventsController constructor.
     * @param EventService $service
     * @param SerializerInterface $serializer
     */
    public function __construct(EventService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function create(Request $request)
    {
        $request = $this->transformJsonBody($request);

        $title = $request->get('title');
        $category_id = $request->get('category_id');

        $data = $this->service->createEvent($title, $category_id);

        $serialized_data = $this->serializer->serialize($data, 'json', ['groups' => ['activity', 'main']]);

        return $this->response($serialized_data, Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getEvents(Request $request)
    {
        $size = $request->get('size') ?? 10;

        $data = $this->service->findAll($size);

        $serialized_data = $this->serializer->serialize($data, 'json', ['groups' => ['activity', 'main']]);

        return $this->response($serialized_data);
    }
}