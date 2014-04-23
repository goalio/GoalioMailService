<?php

namespace GoalioMailServiceTest\Mail\View;

use GoalioMailService\Mail\View\MailPhpRendererFactory;
use GoalioMailServiceTest\Util\ServiceManagerFactory;

class MailPhpRendererFactoryTest extends \PHPUnit_Framework_TestCase {

    protected $sm;

    public function setUp() {

    }

    public function testCreateViaServiceManager() {
        $sm = ServiceManagerFactory::getServiceManager();
        $options = $sm->get('goaliomailservice_renderer');

        $this->assertInstanceOf('Zend\View\Renderer\PhpRenderer', $options);
    }

    public function testCreateService() {
        $sm = ServiceManagerFactory::getServiceManager();
        $factory = new MailPhpRendererFactory();
        $options = $factory->createService($sm, 'goaliomailservicerenderer');

        $this->assertInstanceOf('Zend\View\Renderer\PhpRenderer', $options);
    }
}