<?php

namespace GoalioMailServiceTest\Mail\Service;

use GoalioMailService\Mail\Service\Message;
use GoalioMailServiceTest\Util\ServiceManagerFactory;

class MessageTest extends \PHPUnit_Framework_TestCase {

    /** @var  Message */
    protected $message;

    public function setUp() {
        $renderer = $this->getMock('Zend\View\Renderer\PhpRenderer', array('render'));
        $renderer->expects($this->any())
            ->method('render')
            ->will($this->returnValue('Content'));

        $transport = $this->getMock('Zend\Mail\Transport\File', array('send'));
        $transport->expects($this->any())
            ->method('send');

        $this->message = new Message();
        $this->message->setRenderer($renderer);
        $this->message->setTransport($transport);
    }


    public function testCreateHtmlMessage() {
        $from    = 'foo@test.dev';
        $to      = 'bar@test.dev';
        $subject = 'Test';
        $nameOrModel = array();
        $values      = array();

        /** @var \Zend\Mail\Message $message */
        $message = $this->message->createHtmlMessage($from, $to, $subject, $nameOrModel, $values);

        $this->assertInstanceOf('Zend\Mail\Message', $message);
    }


    public function testCreateTextMessage() {
        $from    = 'foo@test.dev';
        $to      = 'bar@test.dev';
        $subject = 'Test';
        $nameOrModel = array();
        $values      = array();

        /** @var \Zend\Mail\Message $message */
        $message = $this->message->createTextMessage($from, $to, $subject, $nameOrModel, $values);

        $this->assertInstanceOf('Zend\Mail\Message', $message);
    }

    public function testSend() {
        $transport = $this->getMock('Zend\Mail\Transport\File', array('send'));
        $transport->expects($this->once())
            ->method('send');

        $this->message->setTransport($transport);

        $message = new \Zend\Mail\Message();
        $this->message->send($message);
    }

    public function testGetServiceManager() {
        $this->assertEquals(null, $this->message->getServiceManager());
    }

    public function testSetGetServiceManager() {
        $sm = ServiceManagerFactory::getServiceManager();
        $this->message->setServiceManager($sm);
        $this->assertEquals($sm, $this->message->getServiceManager());
    }

    public function testGetRenderer() {
        $this->assertInstanceOf('Zend\View\Renderer\PhpRenderer', $this->message->getRenderer());
    }

    public function testSetGetRenderer() {
        $renderer = 'NewRenderer';
        $this->message->setRenderer($renderer);
        $this->assertEquals($renderer, $this->message->getRenderer());
    }

    public function testGetTransport() {
        $this->assertInstanceOf('Zend\Mail\Transport\TransportInterface', $this->message->getTransport());
    }

    public function testSetGetTransport() {
        $transport = 'NewTransport';
        $this->message->setTransport($transport);
        $this->assertEquals($transport, $this->message->getTransport());
    }
}