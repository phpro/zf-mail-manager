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
     * This method will check if the specified e-mail can be send.
     *
     * @param MailInterface $mail
     *
     * @return bool
     */
    public function canSend(MailInterface $mail);

    /**
     * @param MailInterface $mail
     *
     * @return void
     */
    public function send(MailInterface $mail);
}
