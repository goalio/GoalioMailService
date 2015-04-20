<?php
namespace GoalioMailService\View\Helper;

use Zend\Mime\Message as MimeMessage;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Mime;

class Mail extends AbstractHelper {

    /**
     * @var array
     */
    protected $attachments = array();

    /**
     * @return $this
     */
    public function __invoke() {
        return $this;
    }

    /**
     * @return MimeMessage
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     *
     */
    public function resetAttachments()
    {
        $this->attachments = array();
    }

    /**
     * @param $path
     * @param null $filename
     * @return string
     */
    public function embed($path, $filename = null) {
        $path = 'public' . $path;

        if($filename === null) {
            $filename = basename($path);
        }

        $attachment = file_get_contents($path);
        $this->attachments[$filename] = $attachment;

        return 'cid:' . $filename;
    }

//    /**
//     * @param $path
//     * @param null $filename
//     */
//    public function attach($path, $filename = null) {
//        if($filename === null) {
//            $filename = basename($path);
//        }
//        $this->attachements[$filename] = $path;
//    }


}