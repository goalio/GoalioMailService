<?php
namespace GoalioMailService;

use Zend\Mvc\MvcEvent;

class Module {

    public function init() {

    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
                'Zend\Loader\StandardAutoloader' => array(
                        'namespaces' => array(
                                __NAMESPACE__      => __DIR__ . '/src/' . __NAMESPACE__,
                        ),
                ),
        );
    }

    public function getServiceConfig() {
        return array(
            'shared' => array(
                 'goaliomailservice_message' => false
            ),
            'invokables' => array(
                'goaliomailservice_message'   => 'GoalioMailService\Mail\Service\Message',
            ),
            'factories' => array(
                'goaliomailservice_transport' => 'GoalioMailService\Mail\Transport\Service\TransportFactory',
            ),
        );
    }


    public function onBootstrap(MvcEvent $e) {

    }
}

