<?php

namespace Phpro\MailManager\Adapter;

use Phpro\MailManager\Mail\MailInterface;
use Phpro\MailManager\Mail\MandrillMailInterface;
use SlmMail\Mail\Message\Mandrill;
use Zend\Mail\Transport\TransportInterface;

/**
 * Class MandrillMailAdapter
 *
 * @package Phpro\MailManager\Adapter
 */
class MandrillMailAdapter implements AdapterInterface
{

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @param $transport
     */
    public function __construct($transport)
    {
        $this->transport = $transport;
    }

    /**
     * {@inheritdoc}
     */
    public function canSend(MailInterface $mail)
    {
        return $mail instanceof MandrillMailInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function send(MailInterface $mail)
    {
        $message = $this->createMessage($mail);
        $this->transport->send($message);
    }

    /**
     * @param MandrillMailInterface $mail
     *
     * @return Mandrill
     */
    protected function createMessage(MandrillMailInterface $mail)
    {
        $message = new Mandrill();
        $message->getHeaders()->addHeaders($mail->getHeaders());
        $message->setTo($mail->getTo());
        $message->setCc($mail->getCc());
        $message->setBcc($mail->getBcc());

        if ($mail->getFrom()) {
            $message->setFrom($mail->getFrom());
        }

        if ($mail->getSubject()) {
            $message->setSubject($mail->getSubject());
        }

        $message->setOptions($mail->getOptions());
        $message->setTags($mail->getTags());
        $message->setTemplate($mail->getTemplate());
        $message->setTemplateContent($mail->getTemplateContent());
        $message->setGlobalVariables($mail->getGlobalVariables());
        $message->setGlobalMetadata($mail->getGlobalMetadata());
        $message->setImages($mail->getImages());

        if ($mail->getVariables()) {
            foreach ($mail->getVariables() as $recipient => $variables) {
                $message->setVariables($recipient, $variables);
            }
        }

        if ($mail->getMetadata()) {
            foreach ($mail->getMetadata() as $recipient => $metadata) {
                $message->setMetadata($recipient, $metadata);
            }
        }

        return $message;
    }


}
