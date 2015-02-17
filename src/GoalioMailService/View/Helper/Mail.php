<?php
namespace GoalioMailService\View\Helper;

use GoalioMailService\View\Model\MailModel;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Exception;

class Mail extends AbstractHelper {

    /**
     * @var MailModel
     */
    protected $mailModel;

    /**
     * @return $this
     */
    public function __invoke() {
        return $this;
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

        stop();

        return 'cid:' . $filename;
    }

    /**
     * @return MailModel
     */
    public function getMailModel()
    {
        return $this->mailModel;
    }

    /**
     * @param MailModel $mailModel
     */
    public function setMailModel($mailModel)
    {
        $this->mailModel = $mailModel;
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