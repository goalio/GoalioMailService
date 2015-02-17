<?php
namespace GoalioMailService\View\Model;

use Zend\View\Model\ModelInterface;
use Zend\View\Model\ViewModel;

class MailModel extends ViewModel {

    const HTML_PART = 'html';
    const TEXT_PART = 'text';

    /**
     * @var array
     */
    protected $inlineAttachements = array();

    /**
     * @var array
     */
    protected $attachements = array();

    /**
     * @return array
     */
    public function getAttachements()
    {
        return $this->attachements;
    }

    /**
     * @param array $attachements
     */
    public function setAttachements($attachements)
    {
        $this->attachements = $attachements;
    }

    /**
     * @return array
     */
    public function getInlineAttachements()
    {
        return $this->inlineAttachements;
    }

    /**
     * @param array $inlineAttachements
     */
    public function setInlineAttachements($inlineAttachements)
    {
        $this->inlineAttachements = $inlineAttachements;
    }

    /**
     * Add a child model for text
     *
     * @param  ModelInterface $child
     * @param  null|bool $append Optional; if specified, append to child  with the same capture
     * @return ViewModel
     */
    public function addTextChild(ModelInterface $child, $append = null) {
        return $this->addChild($child, static::TEXT_PART, $append);
    }

    /**
     * Add a child model for html
     *
     * @param  ModelInterface $child
     * @param  null|bool $append Optional; if specified, append to child  with the same capture
     * @return ViewModel
     */
    public function addHtmlChild(ModelInterface $child, $append = null) {
        return $this->addChild($child, static::HTML_PART, $append);
    }


}