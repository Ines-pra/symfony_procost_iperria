<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;


class EventError404
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }


    public function onKernelException(ExceptionEvent $event)
    {
        // If not a HttpNotFoundException ignore
        if (!$event->getThrowable() instanceof NotFoundHttpException) {
            return;
        }


        // Create redirect response with url for the home page
        $response = new RedirectResponse($this->router->generate('main_notfound'));

        // Set the response to be processed
        $event->setResponse($response);
    }
}