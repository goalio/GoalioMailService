<?php
namespace GoalioMailService\Mail\Transport\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class TransportFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {

        /** @var TransportOptions $options */
        $config = $serviceLocator->get('config');
        $options = $config['goaliomailservice'];
        return \Zend\Mail\Transport\Factory::create($options);
    }
}
