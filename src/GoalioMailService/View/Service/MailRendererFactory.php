<?php
namespace GoalioMailService\View\Service;

use GoalioMailService\View\Renderer\MailRenderer;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class MailRendererFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new MailRenderer();
    }

}