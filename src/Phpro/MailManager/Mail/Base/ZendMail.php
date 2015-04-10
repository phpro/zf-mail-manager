<?php

namespace Phpro\MailManager\Mail\Base;

use Phpro\MailManager\Mail\ZendMailInterface;

/**
 * Class ZendMail
 *
 * @package Phpro\MailManager\Mail\Base
 */
class ZendMail extends Mail
    implements ZendMailInterface
{

    /**
     * @var string
     */
    protected $viewFile;

    /**
     * @var string
     */
    protected $layoutFile = 'mails/layout';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param string $viewFile
     */
    public function setViewFile($viewFile)
    {
        $this->viewFile = $viewFile;
    }

    /**
     * @return string
     */
    public function getViewFile()
    {
        return $this->viewFile;
    }

    /**
     * @param string $layoutFile
     */
    public function setLayoutFile($layoutFile)
    {
        $this->layoutFile = $layoutFile;
    }

    /**
     * @return string
     */
    public function getLayoutFile()
    {
        return $this->layoutFile;
    }
}
