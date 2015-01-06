<?php
namespace GoalioMailService\View\Service;

use GoalioMailService\View\Strategy\MailStrategy;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class MailStrategyFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $mailRenderer = $serviceLocator->get('GoalioMailService\MailRenderer');
        return new MailStrategy($mailRenderer);
    }


}