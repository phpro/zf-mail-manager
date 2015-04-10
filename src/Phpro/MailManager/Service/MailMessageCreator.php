<?php

namespace Phpro\MailManager\Service;

use Phpro\MailManager\Mail\RenderableMailInterface;
use Zend\Mail;
use Zend\Mime;

/**
 * Class MessageCreator
 *
 * @package Phpro\MailManager\Service
 */
class MailMessageCreator
{

    /**
     * @var BodyRenderer
     */
    protected $bodyRenderer;

    /**
     * @param $bodyRenderer
     */
    public function __construct($bodyRenderer)
    {
        $this->bodyRenderer = $bodyRenderer;
    }

    /**
     * @param RenderableMailInterface $mail
     *
     * @return Mime\Message
     */
    public function createMessage(RenderableMailInterface $mail)
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
     * @param RenderableMailInterface $mail
     *
     * @return Mime\Part
     */
    protected function getMailBody(RenderableMailInterface $mail)
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
