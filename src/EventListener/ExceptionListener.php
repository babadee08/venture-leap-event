<?php


namespace App\EventListener;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    /**
     * Global even handler for handling all Exceptions
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $response = new JsonResponse();

        if ($exception instanceof UniqueConstraintViolationException) {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setData([ 'status' => 'error', 'message' => 'Duplicate entry' ]);
        } else if ($exception instanceof NotFoundHttpException) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->setData([ 'status' => 'error', 'message' => 'Not Found' ]);
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->setData([ 'status' => 'error', 'message' => $exception->getMessage() ]);
        }

        $event->setResponse($response);
    }

}