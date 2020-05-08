<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{

    /**
     * @param $data
     * @param int $status_code
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, int $status_code = 200, $headers = [])
    {
        $data = is_array($data) ? $data : json_decode($data);
        return new JsonResponse($data, $status_code, $headers);
    }

    /**
     * @param Request $request
     * @return Request
     */
    protected function transformJsonBody(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}