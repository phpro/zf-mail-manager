<?php


namespace Phpro\MailManager\Mail;

/**
 * Interface ZendMailInterface
 *
 * @package Phpro\MailManager\Mail
 */
interface ZendMailInterface extends MailInterface
{

    /**
     * @return array
     */
    public function getParams();

    /**
     * @return string
     */
    public function getViewFile();

    /**
     * @return string
     */
    public function getLayoutFile();

}
