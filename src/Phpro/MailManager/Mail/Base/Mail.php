<?php

namespace Phpro\MailManager\Mail\Base;

use Phpro\MailManager\Mail\MailInterface;
use Zend\Mail\Header\HeaderInterface;
use Zend\Mail\Headers;

/**
 * Class Mail
 *
 * @package Phpro\MailManager\Mail\Base
 */
class Mail
    implements MailInterface
{

    /**
     * @var array
     */
    protected $to = [];

    /**
     * @var array
     */
    protected $cc = [];

    /**
     * @var array
     */
    protected $bcc = [];

    /**
     * @var array
     */
    protected $from = [];

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var Headers
     */
    protected $headers;

    /**
     * @var array
     */
    protected $attachments = [];

    /**
     * @param      $file
     * @param null $name
     */
    public function addAttachment($file, $name = null)
    {
        $name = $name ? $name : pathinfo($file, PATHINFO_BASENAME);
        $this->attachments[$name] = $file;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param      $email
     * @param null $name
     */
    public function addBcc($email, $name = null)
    {
        if ($name) {
            $this->bcc[$email] = $name;
            return;
        }
        $this->bcc[] = $email;
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param      $email
     * @param null $name
     */
    public function addCc($email, $name = null)
    {
        if ($name) {
            $this->cc[$email] = $name;
            return;
        }
        $this->cc[] = $email;
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param      $email
     * @param null $name
     */
    public function setFrom($email, $name = null)
    {
        $this->from = [];
        if ($name) {
            $this->from[$email] = $name;
            return;
        }
        $this->from[] = $email;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param      $email
     * @param null $name
     */
    public function addTo($email, $name = null)
    {
        if ($name) {
            $this->to[$email] = $name;
            return;
        }
        $this->to[] = $email;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param HeaderInterface $header
     */
    public function addHeader(HeaderInterface $header)
    {
        $this->getHeaders()->addHeader($header);
    }

    /**
     * @param array $headers
     */
    public function addHeaders($headers)
    {
        $this->getHeaders()->addHeaders($headers);
    }

    /**
     * @return Headers
     */
    public function getHeaders()
    {
        if (!$this->headers) {
            $this->headers = new Headers();
        }
        return $this->headers;
    }

}
