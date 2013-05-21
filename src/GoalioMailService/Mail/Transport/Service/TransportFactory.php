<?php
namespace GoalioMailService\Mail\Transport\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class TransportFactory implements FactoryInterface {


    public function createService(ServiceLocatorInterface $serviceLocator) {

        $config = $serviceLocator->get('Config');

        $transportOptions = (isset($config['goaliomailservice']) ? $config['goaliomailservice'] : array());

        if(isset($transportOptions['transport_object'])) {
            $transport = $serviceLocator->get($transportOptions['transport_object']);
        } elseif (isset($transportOptions['transport_class'])) {
            $transportClass = $transportOptions['transport_class'];
            $transport = new $transportClass();

            if(isset($transportOptions['options_class'])) {
                $optionsClass = $transportOptions['options_class'];
                $options = new $optionsClass($transportOptions['options']);
                $transport->setOptions($options);
            }
        } else {
            throw new Exception('Either transport class or transport object have to be configured');
        }

        return $transport;
    }
}