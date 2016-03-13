<?php

namespace Drupal\skeleton\Services;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class CustomBuildServices {


    /**
     * @var LoggerChannelFactoryInterface
     */
    private $loggerFactory;

    public function __construct(LoggerChannelFactoryInterface $loggerFactory){
        $this->loggerFactory = $loggerFactory;
    }

    public function service_example(){
        $serviceMessage = 'This message is from custom service';
        $this->loggerFactory->get('default')->debug($serviceMessage);
        return $serviceMessage;
    }
}