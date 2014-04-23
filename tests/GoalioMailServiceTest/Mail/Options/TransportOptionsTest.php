<?php

namespace GoalioMailServiceTest\Mail\Options;

use GoalioMailService\Mail\Options\TransportOptions;

class TransportOptionsTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var TransportOptions $options
     */
    protected $transportOptions;

    public function setUp() {
        $transportOptions = new TransportOptions();
        $this->transportOptions = $transportOptions;
    }

    public function testGetTransportClass() {
        $this->assertEquals('Zend\Mail\Transport\File', $this->transportOptions->getTransportClass());
    }

    public function testSetGetTransportClass() {
        $transportClass = 'NewTransportClass';
        $this->transportOptions->setTransportClass($transportClass);
        $this->assertEquals($transportClass, $this->transportOptions->getTransportClass());
    }

    public function testGetOptionsClass() {
        $this->assertEquals('Zend\Mail\Transport\FileOptions', $this->transportOptions->getOptionsClass());
    }

    public function testSetGetOptionsClass() {
        $optionsClass = 'NewOptionsClass';
        $this->transportOptions->setOptionsClass($optionsClass);
        $this->assertEquals($optionsClass, $this->transportOptions->getOptionsClass());
    }

    public function testGetTransportOptions() {
        $this->assertEquals(array('path' => 'data/mail/'), $this->transportOptions->getTransportOptions());
    }

    public function testSetGetTransportOptions() {
        $transportOptions = 'NewOptions';
        $this->transportOptions->setTransportOptions($transportOptions);
        $this->assertEquals($transportOptions, $this->transportOptions->getTransportOptions());
    }

}