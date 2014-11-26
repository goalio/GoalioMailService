<?php
namespace GoalioMailService\Mail\Service;

use GoalioMailService\Mail\Transport\TransportManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class TransportFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var TransportManager $transportManager */
        $transportManager  = $serviceLocator->get('goaliomailservice\transportmanager');

        $config  = $serviceLocator->get('config');
        $config = $config['goaliomailservice'];

        return $transportManager->get($config['type'], $config['options']);
    }
}
