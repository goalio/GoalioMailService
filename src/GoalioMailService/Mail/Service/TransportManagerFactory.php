<?php
namespace GoalioMailService\Mail\Service;

use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Zend\ServiceManager\Config as ServiceManagerConfig;
use Zend\ServiceManager\ServiceLocatorInterface;

class TransportManagerFactory extends AbstractPluginManagerFactory {

    const PLUGIN_MANAGER_CLASS = '\GoalioMailService\Mail\Transport\TransportManager';

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $transportManager = parent::createService($serviceLocator);

        $config = $serviceLocator->get('config');
        if(isset($config['mail_transports'])) {
            $config = new ServiceManagerConfig($config['mail_transports']);
            $config->configureServiceManager($transportManager);
        }

        $transportManager->addPeeringServiceManager($serviceLocator);

        return $transportManager;
    }

}