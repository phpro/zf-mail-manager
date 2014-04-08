<?php

namespace spec\Phpro\MailManager\Mail\Stub;


use Prophecy\Prophet;

trait ProvidesMailStubSpec
{

    /**
     * @return \Phpro\MailManager\Mail\MailInterface
     */
    protected  function getMailStub()
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

        $mail->getParams()->willReturn(['param1' => 'value1']);
        $mail->getViewFile()->willReturn('view-file');
        $mail->getLayoutFile()->willReturn('layout-file');

        $mail->getHeaders()->willReturn($headers);
        $mail->getAttachments()->willReturn(['name' => '/tmp/file.txt']);

        return $mail->reveal();
    }

}
