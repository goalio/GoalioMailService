<?php
namespace GoalioMailService\Mail;

use GoalioMailService\View\Model\MailModel;
use Zend\Mail\Transport\TransportInterface;
use Zend\Stdlib\Response;
use Zend\View\Model\ViewModel;
use Zend\Mail\Message as MailMessage;
use Zend\View\View;

class Mailer {

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var View
     */
    protected $view;

    /**
     * @return TransportInterface
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param TransportInterface $transport
     * @return $this
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param View $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * Return a HTML message ready to be sent
     *
     * @param array|string $from A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to An array containing the recipients of the mail
     * @param string $subject Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel Either the template to use, or a ViewModel
     * @param null|array $values Values to use when the template is rendered
     * @return MailMessage
     * @deprecated
     */
    public function createHtmlMessage($from, $to, $subject, $nameOrModel, $values = array())
    {
        if(!$nameOrModel instanceof ViewModel) {
            $name = $nameOrModel;
            $nameOrModel = new ViewModel($values);
            $nameOrModel->setTemplate($name);
        }

        $mailModel = new MailModel();
        $mailModel->addHtmlChild($nameOrModel);

        $view = $this->getView();

        $response = new Response();
        $view->setResponse($response);
        $view->render($mailModel);

        /** @var MailMessage $message */
        $message = $response->getContent();
        $message->setSubject($subject);

        $message->setFrom($from['email'], $from['name']);
        $message->setTo($to);

        return $message;
    }

    /**
     * Return a text message ready to be sent
     *
     * @param array|string $from A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to An array containing the recipients of the mail
     * @param string $subject Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel Either the template to use, or a ViewModel
     * @param null|array $values Values to use when the template is rendered
     * @return MailMessage
     * @deprecated
     */
    public function createTextMessage($from, $to, $subject, $nameOrModel, $values = array())
    {
        if(!$nameOrModel instanceof ViewModel) {
            $name = $nameOrModel;
            $nameOrModel = new ViewModel($values);
            $nameOrModel->setTemplate($name);
        }

        $mailModel = new MailModel();
        $mailModel->addTextChild($nameOrModel);

        $view = $this->getView();

        $response = new Response();
        $view->setResponse($response);
        $view->render($mailModel);

        /** @var MailMessage $message */
        $message = $response->getContent();
        $message->setSubject($subject);

        $message->setFrom($from['email'], $from['name']);
        $message->setTo($to);

        return $message;
    }

    /**
     * @param MailMessage $message
     * @return mixed
     */
    public function send(MailMessage $message)
    {
        return $this->getTransport()->send($message);
    }



}