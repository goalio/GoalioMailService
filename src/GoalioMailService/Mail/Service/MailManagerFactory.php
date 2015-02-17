<?php
namespace GoalioMailService\Mail\Service;

use GoalioMailService\Mail\MailManager;
use Zend\Mail\Transport\TransportInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\View\View;

class MailManagerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mailManager = new MailManager();

        /** @var TransportInterface $transport */
        $transport = $serviceLocator->get('GoalioMailService\Transport');
        $mailManager->setTransport($transport);

        /** @var View $view */
        $view = $serviceLocator->get('View');
        $mailManager->setView($view);

        $config = $serviceLocator->get('config');
        $options = $config['goalio-mail'];
        $mailManager->setOptions($options);

        return $mailManager;
    }
}
