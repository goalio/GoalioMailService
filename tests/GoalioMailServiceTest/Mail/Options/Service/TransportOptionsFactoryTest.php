<?php

namespace GoalioMailServiceTest\Mail\Options\Service;

use GoalioMailService\Mail\Options\Service\TransportOptionsFactory;
use GoalioMailServiceTest\Util\ServiceManagerFactory;

class TransportOptionsFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateViaServiceManager() {
        $sm = ServiceManagerFactory::getServiceManager();
        $options = $sm->get('goaliomailservice_options');

        $this->assertInstanceOf('GoalioMailService\Mail\Options\TransportOptions', $options);
    }

    public function testCreateService() {
        $sm = ServiceManagerFactory::getServiceManager();
        $factory = new TransportOptionsFactory();
        $options = $factory->createService($sm, 'goaliomailserviceoptions', 'GoalioMailServiceTest\Mail\Options\TransportOptions');

        $this->assertInstanceOf('GoalioMailService\Mail\Options\TransportOptions', $options);
    }
}