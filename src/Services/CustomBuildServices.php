<?php

namespace Drupal\skeleton\Services;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class CustomBuildServices {


    /**
     * @var LoggerChannelFactoryInterface
     */
    private $loggerFactory;
    private $errorLogging;

    /**
     * @param LoggerChannelFactoryInterface $loggerFactory
     * @param $errorLogging
     */
    public function __construct(LoggerChannelFactoryInterface $loggerFactory,$errorLogging){
        $this->loggerFactory = $loggerFactory;
        $this->errorLogging = $errorLogging;
    }

    /**
     * @return string
     */
    public function service_example(){
        $serviceMessage = 'This message is from custom service';
        // Check for the errorlogging status from the configuration file.
        if($this->errorLogging){
            $this->loggerFactory->get('default')->debug($serviceMessage);
        }
        return $serviceMessage;
    }
}