<?php
namespace Application;

use Application\Utils\SettingsRegistry;
use Zend\EventManager\Event;
use Zend\Http\Request as HttpRequest;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SaveHandler\Cache;

/**
 * Class Module
 *
 * @package Application
 * @author  Chuck "MANCHUCK" Reeves <chuck@manchuck.com>
 */
class Module
{
    /**
     * @param MvcEvent $event
     */
    public function onBootstrap(MvcEvent $event)
    {
        if ($event->getRequest() instanceof HttpRequest) {
            $eventManager = $event->getApplication()->getEventManager();
            $moduleRouteListener = new ModuleRouteListener();
            $moduleRouteListener->attach($eventManager);
        }
    }

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

    /**
     * @param ModuleManager $moduleManager
     */
    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager();
        $events->attach('loadModules.post', [$this, 'registerErrorHandler']);
    }

    /**
     * @param Event $event
     */
    public function registerErrorHandler(Event $event)
    {
        $service = $event->getParam('ServiceManager');
        if (!$service->has('Log\App')) {
            return;
        }

        /** @var \Zend\Log\Logger $logger */
        $logger = $service->get('Log\App');
        $logger::registerErrorHandler($logger);
        $logger::registerExceptionHandler($logger);
        $logger::registerFatalErrorShutdownFunction($logger);
    }
}
