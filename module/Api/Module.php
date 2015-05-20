<?php

namespace Api;

/**
 * Class Module
 *
 * @package Application
 * @author  Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class Module
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [__DIR__ . '/autoload_classmap.php'],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__ . '/']
            ]
        ];
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
