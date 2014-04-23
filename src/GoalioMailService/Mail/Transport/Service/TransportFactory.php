<?php
namespace GoalioMailService\Mail\Transport\Service;

use GoalioMailService\Mail\Options\TransportOptions;
use Zend\Mail\Transport\TransportInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class TransportFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {

        /** @var TransportOptions $options */
        $options = $serviceLocator->get('goaliomailservice_options');

        if(!class_exists($options->getTransportClass())) {
            throw new \Exception('Transport class has to be configured');
        }

        $transportClass = $options->getTransportClass();

        /** @var TransportInterface $transport */
        $transport = new $transportClass;

        if(class_exists($options->getOptionsClass())) {
            $transportOptionsClass = $options->getOptionsClass();
            $transportOptions = new $transportOptionsClass;
            $transportOptions->setFromArray($options->getTransportOptions());
            $transport->setOptions($transportOptions);
        }

        return $transport;
    }
}