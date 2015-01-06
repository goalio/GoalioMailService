<?php
namespace GoalioMailService\Mail\Service;

use GoalioMailService\Mail\Mailer;
use Zend\Mail\Transport\TransportInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\View\View;

class MailerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mailer = new Mailer();

        /** @var TransportInterface $transport */
        $transport = $serviceLocator->get('GoalioMailService\Transport');
        $mailer->setTransport($transport);

        /** @var View $view */
        $view = $serviceLocator->get('View');
        $mailer->setView($view);

        return $mailer;
    }
}
