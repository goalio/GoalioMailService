<?php
namespace GoalioMailService\Mail\Transport;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\Mail\Transport;

class TransportManager extends AbstractPluginManager {


    public function get($name, $options = array(), $usePeeringServiceManagers = true)
    {
        // Allow specifying a class name directly; registers as an invokable class
        if (!$this->has($name) && $this->autoAddInvokableClass && class_exists($name)) {
            $this->setInvokableClass($name, $name);
        }

        $this->creationOptions = $options;
        $instance = parent::get($name, $usePeeringServiceManagers);
        $this->creationOptions = null;
        $this->validatePlugin($instance);
        return $instance;
    }

    /**
     * Validate the plugin
     *
     * Checks that the helper loaded is an instance of Transport\TransportInterface.
     *
     * @param  mixed                            $plugin
     * @return void
     * @throws Exception\InvalidTransportException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Transport\TransportInterface) {
            // we're okay
            return;
        }

        throw new Exception\InvalidTransportException(sprintf(
            'Plugin of type %s is invalid; must implement Zend\Mail\Transport\TransportInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}