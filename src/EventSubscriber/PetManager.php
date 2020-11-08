<?php
// api/src/EventSubscriber/petManager.php

namespace App\EventSubscriber;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Pet;
use App\Exception\Api\Pets\PetNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class PetManager implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['checkPetAvailability', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function checkPetAvailability(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $request = $event->getRequest();

        if (
            $request->get('_api_resource_class') != Pet::class
            || $request->get('_api_item_operation_name') != 'get'
        ) {
            return;
        }

        $response = new Response();

        $response->setContent(json_encode([
            'code' => 404,
            'description' => 'The pet does not exist'
            ])
        );

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}