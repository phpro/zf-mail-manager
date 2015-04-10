<?php

namespace Phpro\MailManager\Adapter;

use Phpro\MailManager\Mail\MailInterface;
use Phpro\MailManager\Mail\ZendMailInterface;
use Phpro\MailManager\Service\MailMessageCreator;
use Zend\Mail;

/**
 * Class ZendMailAdapter
 *
 * @package Phpro\MailManager\Adapter
 */
class ZendMailAdapter
    implements AdapterInterface
{

    /**
     * @var Mail\Transport\TransportInterface
     */
    protected $transport;

    /**
     * @var MailMessageCreator
     */
    protected $messageCreator;

    /**
     * @param $transport
     * @param $messageCreator
     */
    public function __construct($transport, $messageCreator)
    {
        $this->transport = $transport;
        $this->messageCreator = $messageCreator;
    }

    /**
     * {@inheritdoc}
     */
    public function canSend(MailInterface $mail)
    {
        return ($mail instanceof ZendMailInterface);
    }

    /**
     * @param MailInterface $mail
     */
    public function send(MailInterface $mail)
    {
        $message = $this->createMessage($mail);
        $this->transport->send($message);
    }

    /**
     * @param ZendMailInterface $mail
     *
     * @return Mail\Message
     */
    protected function createMessage(ZendMailInterface $mail)
    {
        $message = new Mail\Message();
        $message->getHeaders()->addHeaders($mail->getHeaders());
        $message->setTo($mail->getTo());
        $message->setCc($mail->getCc());
        $message->setBcc($mail->getBcc());
        $message->setFrom($mail->getFrom());
        $message->setSubject($mail->getSubject());
        $message->setBody($this->messageCreator->createMessage($mail));

        return $message;
    }
}
