<?php
namespace GoalioMailService\Mail\Transport;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Factory extends \Zend\Mail\Transport\Factory implements AbstractFactoryInterface {

    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        return isset(static::$classMap[$name]);
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface|TransportManager $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        $config = $serviceLocator->getServiceLocator()->get('config');
        $config = $config['goaliomailservice'];

        $transport = static::create($config);
        return $transport;
    }
}
