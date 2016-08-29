<?php

namespace Phpro\MailManager\Adapter;

use Phpro\MailManager\Mail\MailInterface;
use Phpro\MailManager\Mail\MandrillInterface;
use Phpro\MailManager\Service\MailMessageCreator;
use SlmMail\Mail\Message\Mandrill as MandrillMessage;
use Zend\Mail\Transport\TransportInterface;

/**
 * Class MandrillAdapter
 *
 * @package Phpro\MailManager\Adapter
 */
class MandrillAdapter implements AdapterInterface
{

    /**
     * @var TransportInterface
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
        return $mail instanceof MandrillInterface;
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
     * @param MandrillInterface $mail
     *
     * @return Mandrill
     */
    protected function createMessage(MandrillInterface $mail)
    {
        $message = new MandrillMessage();
        $message->getHeaders()->addHeaders($mail->getHeaders());
        $message->setTo($mail->getTo());
        $message->setCc($mail->getCc());
        $message->setBcc($mail->getBcc());
        $message->setReplyTo($mail->getReplyTo());

        if ($mail->getFrom()) {
            $message->setFrom($mail->getFrom());
        }

        if ($mail->getSubject()) {
            $message->setSubject($mail->getSubject());
        }

        $message->setOptions($mail->getOptions());
        $message->setTags($mail->getTags());
        $message->setImages($mail->getImages());

        if ($mail->useMandrillTemplate()) {
            // USe build-in template functionality in mandrill?
            $message->setTemplate($mail->getTemplate());
            $message->setTemplateContent($mail->getTemplateContent());
            $message->setGlobalVariables($mail->getGlobalVariables());
            $message->setGlobalMetadata($mail->getGlobalMetadata());

            if ($mail->getVariables()) {
                foreach ($mail->getVariables() as $recipient => $variables) {
                    $message->setVariables($recipient, $variables);
                }
            }
        } else {
            // Use the bodyrenderer
            $message->setBody($this->messageCreator->createMessage($mail));
        }

        if ($mail->getMetadata()) {
            foreach ($mail->getMetadata() as $recipient => $metadata) {
                $message->setMetadata($recipient, $metadata);
            }
        }

        return $message;
    }
}
