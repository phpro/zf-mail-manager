<?php

namespace stub\Phpro\MailManager\Mail;

use Prophecy\Prophet;

trait ProvidesZendMailStubSpec
{

    /**
     * @return \Phpro\MailManager\Mail\ZendMailInterface
     */
    protected function getMailStub()
    {
        $prophet = new Prophet();

        /** @var \Phpro\MailManager\Mail\ZendMailInterface $mail */
        $mail = $prophet->prophesize('Phpro\MailManager\Mail\ZendMailInterface');
        $headers = $prophet->prophesize('Zend\Mail\Headers');

        $mail->getTo()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getCc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getBcc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getFrom()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getReplyTo()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getSubject()->willReturn('Subject');

        $mail->getParams()->willReturn(['param1' => 'value1']);
        $mail->getViewFile()->willReturn('view-file');
        $mail->getLayoutFile()->willReturn('layout-file');

        $mail->getHeaders()->willReturn($headers);
        $mail->getAttachments()->willReturn(['name' => '/tmp/file.txt']);

        return $mail->reveal();
    }
}
