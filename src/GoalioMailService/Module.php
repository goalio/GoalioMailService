<?php
namespace GoalioMailService;

use Zend\Mvc\MvcEvent;
use Zend\Loader\StandardAutoloader;
use Zend\Loader\AutoloaderFactory;

class Module {

    public function getAutoloaderConfig() {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }
}

