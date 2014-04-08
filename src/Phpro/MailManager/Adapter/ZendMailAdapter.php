<?php

namespace Phpro\MailManager\Adapter;
use Phpro\MailManager\Mail\MailInterface;

use Phpro\MailManager\Service\BodyRenderer;
use Zend\Mail;
use Zend\Mime;

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
     * @var BodyRenderer
     */
    protected $bodyRenderer;

    /**
     * @param $transport
     * @param $bodyRenderer
     */
    public function __construct($transport, $bodyRenderer)
    {
        $this->transport = $transport;
        $this->bodyRenderer = $bodyRenderer;
    }

    /**
     * @param MailInterface $mail
     */
    public function send(MailInterface $mail)
    {
        $body = $this->createMailMessage($mail);

        $message = new Mail\Message();
        $message->getHeaders()->addHeaders($mail->getHeaders());
        $message->setTo($mail->getTo());
        $message->setCc($mail->getCc());
        $message->setBcc($mail->getBcc());
        $message->setFrom($mail->getFrom());
        $message->setSubject($mail->getSubject());
        $message->setBody($body);

        $this->transport->send($message);
    }

    /**
     * @param MailInterface $mail
     *
     * @return Mime\Message
     */
    protected function createMailMessage(MailInterface $mail)
    {
        $content = $this->getMailBody($mail);
        $message = new Mime\Message();
        $message->addPart($content);

        foreach ($mail->getAttachments() as $name => $file) {
            $attachment = $this->createAttachment($file, $name);
            $message->addPart($attachment);
        }

        return $message;
    }

    /**
     * @param MailInterface $mail
     *
     * @return Mime\Part
     */
    protected function getMailBody(MailInterface $mail)
    {
        $body = $this->bodyRenderer->render($mail);
        $bodyPart = new Mime\Part($body);
        $bodyPart->type = Mime\Mime::TYPE_HTML;

        return $bodyPart;
    }

    /**
     * @param $file
     * @param $name
     *
     * @return Mime\Part
     */
    protected function createAttachment($file, $name)
    {
        $attachment              = new Mime\Part($file);
        $attachment->type        = Mime\Mime::TYPE_OCTETSTREAM;
        $attachment->disposition = Mime\Mime::DISPOSITION_ATTACHMENT;
        $attachment->encoding    = Mime\Mime::ENCODING_BASE64;
        $attachment->filename    = $name;
        $attachment->id          = $name;

        return $attachment;
    }

}
