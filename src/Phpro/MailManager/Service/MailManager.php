<?php

namespace Phpro\MailManager\Service;
use Phpro\MailManager\Adapter\AdapterInterface;
use Phpro\MailManager\Mail\MailInterface;

/**
 * Class MailManager
 *
 * @package Phpro\MailManager\Service
 */
class MailManager
{

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param $adapter
     */
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param MailInterface $mail
     */
    public function send(MailInterface $mail)
    {
        $this->adapter->send($mail);
    }

}
