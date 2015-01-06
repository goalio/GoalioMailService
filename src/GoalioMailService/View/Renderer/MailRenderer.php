<?php
namespace GoalioMailService\View\Renderer;

use Zend\Mail\Message as MailMessage;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Mime;
use Zend\Mime\Part as MimePart;
use GoalioMailService\View\Model\MailModel;
use Zend\View\Model\ModelInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\ResolverInterface;

class MailRenderer implements RendererInterface {

    const ENCODING_UTF8 = 'utf-8'; // Mime::ENCODING_QUOTEDPRINTABLE;

    /**
     * @var string
     */
    protected $encoding = self::ENCODING_UTF8;

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine() {
        return $this;
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @param  ResolverInterface $resolver
     * @return RendererInterface
     */
    public function setResolver(ResolverInterface $resolver)
    {
        return null;
    }

    /**
     * Processes a view script and returns the output.
     *
     * @param  string|ModelInterface   $model       A ViewModel instance
     * @param  null|array|\ArrayAccess $values      Values to use during rendering
     * @return string The script output.
     */
    public function render($model, $values = null)
    {
        if (!$model instanceof MailModel) {
            return '';
        }

        $message = new MailMessage();
        $message->setEncoding($this->getEncoding());

        $body = new MimeMessage();

        // HTML
        $html = $model->getVariable(MailModel::HTML_PART);
        if($html) {
            $part = new MimePart($html);
            $part->type = Mime::TYPE_HTML; // TODO Evaluate "text/html; charset=UTF-8";
            $body->addPart($part);
        }

        // Text
        $text = $model->getVariable(MailModel::TEXT_PART);
        if($text) {
            $part = new MimePart($text);
            $part->type = Mime::TYPE_TEXT;
            $body->addPart($part);
        }

        // Files
        //TODO: Move to event
/*        // Embedded images
        $embedded = $mailViewPlugin->getEmbedded();
        foreach($embedded as $filename => $path) {
            $file = new MimePart(fopen($path, 'r'));
            $file->filename = $filename;
            $file->disposition = 'inline';
            $body->addPart($file);
        }

        // Attachements
        $attachements = $mailViewPlugin->getAttachements();
        foreach($attachements as $filename => $path) {
            $file = new MimePart(fopen($path, 'r'));
            $file->filename = $filename;
            $body->addPart($file);
        }*/


        $message->setBody($body); // Must be last
        return $message;
    }
}