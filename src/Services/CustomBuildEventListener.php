<?php

namespace Drupal\skeleton\Services;


use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CustomBuildEventListener implements EventSubscriberInterface
{

    /**
     * @var
     */
    private $evenlistenerlogger;

    public function __construct(LoggerChannelFactoryInterface $evenlistenerlogger){


        $this->evenlistenerlogger = $evenlistenerlogger;
    }

    public function onKernelRequest(GetResponseEvent $event){
        $request = $event->getRequest();
        if($request->getRequestUri() == '/skeleton-event-subscriber'){
            $this->evenlistenerlogger->get('default')
                ->debug('Skeleton event listener fired.');
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest'
        ];
    }
}