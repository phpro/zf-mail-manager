<?php

namespace Phpro\MailManager\Mail;

use Zend\Mail\Headers;

/**
 * Interface MailInterface
 *
 * @package Phpro\MailManager\Mail
 */
interface MailInterface
{

    /**
     * @return array
     */
    public function getAttachments();

    /**
     * @return array
     */
    public function getBcc();

    /**
     * @return array
     */
    public function getCc();

    /**
     * @return string
     */
    public function getFrom();

    /**
     * @return Headers
     */
    public function getHeaders();

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @return array
     */
    public function getTo();
}
