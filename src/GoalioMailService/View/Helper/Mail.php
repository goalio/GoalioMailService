<?php
namespace GoalioMailService\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Mail extends AbstractHelper {

    /**
     * @var array
     */
    protected $embedded = array();

    /**
     * @var array
     */
    protected $attachements = array();

    /**
     * @return $this
     */
    public function __invoke() {
        return $this;
    }

    /**
     *
     */
    public function clear() {
        $this->embedded = array();
        $this->attachements = array();
    }

    /**
     * @return array
     */
    public function getEmbedded() {
        return $this->embedded;
    }

    /**
     * @return array
     */
    public function getAttachements() {
        return $this->attachements;
    }

    /**
     * @param $path
     * @param null $filename
     * @return string
     */
    public function embed($path, $filename = null) {
        if($filename === null) {
            $filename = basename($path);
        }

        $this->embedded[$filename] = $path;
        return 'cid:' . $filename;
    }

    /**
     * @param $path
     * @param null $filename
     */
    public function attach($path, $filename = null) {
        if($filename === null) {
            $filename = basename($path);
        }
        $this->attachements[$filename] = $path;
    }

}