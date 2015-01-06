<?php
namespace GoalioMailService\View\Strategy;

use GoalioMailService\View\Renderer\MailRenderer;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use GoalioMailService\View\Model;
use Zend\Mail\Message as MailMessage;
use Zend\View\ViewEvent;

class MailStrategy extends AbstractListenerAggregate
{
    /**
     * @var MailRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  MailRenderer $renderer
     */
    public function __construct(MailRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }


    /**
     * Detect if we should use the MailRenderer based on model type
     *
     * @param  ViewEvent $e
     * @return null|MailRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if (!$model instanceof Model\MailModel) {
            // no MustacheModel; do nothing
            return null;
        }

        // MustacheModel found
        return $this->renderer;
    }

    /**
     * Inject the response with the JSON payload and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            // Discovered renderer is not ours; do nothing
            return;
        }

        $result   = $e->getResult();

        if (!$result instanceof MailMessage) {
            // We don't have a Mail composed
            return;
        }

        // Populate response
        $response = $e->getResponse();
        $response->setContent($result);
    }
}
