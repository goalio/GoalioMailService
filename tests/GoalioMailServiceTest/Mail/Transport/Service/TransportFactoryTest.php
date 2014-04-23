<?php

namespace GoalioMailServiceTest\Mail\Options\Service;

use GoalioMailService\Mail\Transport\Service\TransportFactory;
use GoalioMailServiceTest\Util\ServiceManagerFactory;

class TransportFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateViaServiceManager() {
        $sm = ServiceManagerFactory::getServiceManager();
        $transport = $sm->get('goaliomailservice_transport');

        $this->assertInstanceOf('Zend\Mail\Transport\File', $transport);
    }

    public function testCreateService() {
        $sm = ServiceManagerFactory::getServiceManager();
        $factory = new TransportFactory();
        $transport = $factory->createService($sm, 'goaliomailservicetransport');

        $this->assertInstanceOf('Zend\Mail\Transport\File', $transport);
    }

    /**
     * @expectedException Exception
     */
    public function testServiceThrowsExceptionWhenTransportClassNotExists() {
        $sm = ServiceManagerFactory::getServiceManager();

        $options = $sm->get('goaliomailservice_options');
        $options->setTransportClass('DoesNotExist');

        $transport = $sm->get('goaliomailservice_transport');
    }
}