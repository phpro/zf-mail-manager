<?php

namespace Phpro\MailManager\Adapter;
use Phpro\MailManager\Mail\MailInterface;

/**
 * Interface AdapterInterface
 *
 * @package Phpro\MailManager\Adapter
 */
interface AdapterInterface
{

    /**
     * @param MailInterface $mail
     *
     * @return void
     */
    public function send(MailInterface $mail);

}
