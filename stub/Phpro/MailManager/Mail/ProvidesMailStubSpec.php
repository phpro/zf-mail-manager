<?php

namespace stub\Phpro\MailManager\Mail;

use Prophecy\Prophet;

trait ProvidesMailStubSpec
{

    /**
     * @return \Phpro\MailManager\Mail\MailInterface
     */
    protected function getMailStub()
    {
        $prophet = new Prophet();

        /** @var \Phpro\MailManager\Mail\MailInterface $mail */
        $mail = $prophet->prophesize('Phpro\MailManager\Mail\MailInterface');
        $headers = $prophet->prophesize('Zend\Mail\Headers');

        $mail->getTo()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getCc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getBcc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getFrom()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getSubject()->willReturn('Subject');

        $mail->getHeaders()->willReturn($headers);
        $mail->getAttachments()->willReturn(['name' => '/tmp/file.txt']);

        return $mail->reveal();
    }
}
