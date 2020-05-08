<?php


namespace App\Controller;


use App\Services\EventService;
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

    public function __construct(EventService $service, SerializerInterface $serializer)
    {
        $this->service = $service;
        $this->serializer = $serializer;
    }

    public function create(Request $request)
    {
        $request = $this->transformJsonBody($request);
        $title = $request->get('title');
        $category_id = $request->get('category_id');
        $data = $this->service->createEvent($title, $category_id);
        $serialized_data = $this->serializer->serialize($data, 'json', ['groups' => ['activity']]);
        return $this->response(json_decode($serialized_data), Response::HTTP_CREATED);
    }
}