<?php

namespace Application;

use Zend\Log\LoggerAwareInterface;
use Zend\Log\LoggerInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * LogInitializer
 *
 * @author Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class LogInitializer
{
    /**
     * Injects the logger into object that are logger aware
     *
     * @param $object
     * @param ServiceLocatorInterface $service
     */
    public function __invoke($object, ServiceLocatorInterface $service)
    {
        $service = $service instanceof ServiceLocatorAwareInterface
            ? $service->getServiceLocator()
            : $service;

        if (!$object instanceof LoggerAwareInterface || !$service->has('Log\App')) {
            return;
        }

        $logger = $service->get('Log\App');
        if (!$logger instanceof LoggerInterface) {
            return;
        }

        $object->setLogger($logger);
    }
}
