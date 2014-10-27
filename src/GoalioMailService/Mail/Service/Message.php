<?php
namespace GoalioMailService\Mail\Service;

use Zend\Mime\Mime;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\Mail\Message as MailMessage;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class Message implements ServiceManagerAwareInterface {

    /**
     *
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     *
     * @param ServiceManager $serviceManager
     * @return AbstractService
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     *
     * @return ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     *
     * @var \Zend\View\Renderer\RendererInterface
     */
    protected $renderer;

    /**
     *
     * @var \Zend\Mail\Transport\TransportInterface
     */
    protected $transport;

    /**
     * Return a HTML message ready to be sent
     *
     * @param array|string $from
     *            A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to
     *            An array containing the recipients of the mail
     * @param string $subject
     *            Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     *            Either the template to use, or a ViewModel
     * @param null|array $values
     *            Values to use when the template is rendered
     * @return Message
     */
    public function createHtmlMessage($from, $to, $subject, $nameOrModel, $values = array()) {
        $renderer = $this->getRenderer();
        $content = $renderer->render($nameOrModel, $values);

        $text = new MimePart('');
        $text->type = "text/plain";

        $html = new MimePart($content);
        $html->type = "text/html; charset=UTF-8";
        $html->encoding = Mime::ENCODING_QUOTEDPRINTABLE;

        $body = new MimeMessage();
        $body->setParts(array($text, $html));

        return $this->getDefaultMessage($from, 'utf-8', $to, $subject, $body);
    }

    /**
     * Return a text message ready to be sent
     *
     * @param array|string $from
     *            A string containing the sender e-mail address, or if array with keys email and name
     * @param array|string $to
     *            An array containing the recipients of the mail
     * @param string $subject
     *            Subject of the mail
     * @param string|\Zend\View\Model\ModelInterface $nameOrModel
     *            Either the template to use, or a ViewModel
     * @param null|array $values
     *            Values to use when the template is rendered
     * @return Message
     */
    public function createTextMessage($from, $to, $subject, $nameOrModel, $values = array()) {
        $renderer = $this->getRenderer();
        $content = $renderer->render($nameOrModel, $values);

        return $this->getDefaultMessage($from, 'utf-8', $to, $subject, $content);
    }

    /**
     * Send the message
     *
     * @param MailMessage $message
     */
    public function send(MailMessage $message) {
        $this->getTransport()
            ->send($message);
    }

    /**
     * Get the renderer
     *
     * @return \Zend\View\Renderer\RendererInterface
     */
    public function getRenderer() {
        if($this->renderer === null) {
            $serviceManager = $this->getServiceManager();
            $this->renderer = $serviceManager->get('goaliomailservice_renderer');
        }

        return $this->renderer;
    }

    /**
     * @param \Zend\View\Renderer\RendererInterface $renderer
     *
     * @return $this
     */
    public function setRenderer($renderer) {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * Get the transport
     *
     * @return \Zend\Mail\Transport\TransportInterface
     */
    public function getTransport() {
        if($this->transport === null) {
            $this->transport = $this->getServiceManager()
                ->get('goaliomailservice_transport');
        }

        return $this->transport;
    }

    /**
     * @param \Zend\Mail\Transport\TransportInterface $transport
     *
     * @return $this
     */
    public function setTransport($transport) {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @param $from
     * @param $encoding
     * @param $to
     * @param $subject
     * @param $body
     *
     * @return MailMessage
     */
    protected function getDefaultMessage($from, $encoding, $to, $subject, $body) {
        if(is_string($from)) {
            $from = array('email' => $from, 'name' => $from);
        }

        $message = new MailMessage();
        $message->setFrom($from['email'], $from['name'])
            ->setEncoding($encoding)
            ->setSubject($subject)
            ->setBody($body)
            ->setTo($to);

        return $message;
    }
}