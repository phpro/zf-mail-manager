<?php

namespace spec\Phpro\MailManager\Mail\Stub;


use Prophecy\Prophet;

trait ProvidesMandrillMailStubSpec
{

    /**
     * @return \Phpro\MailManager\Mail\MailInterface
     */
    protected function getMailStub()
    {
        $prophet = new Prophet();

        /** @var \Phpro\MailManager\Mail\MandrillMailInterface $mail */
        $mail = $prophet->prophesize('Phpro\MailManager\Mail\MandrillMailInterface');
        $headers = $prophet->prophesize('Zend\Mail\Headers');

        $mail->getTo()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getCc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getBcc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getFrom()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getSubject()->willReturn('Subject');

        $mail->getHeaders()->willReturn($headers);
        $mail->getAttachments()->willReturn(['name' => '/tmp/file.txt']);

        $mail->getOptions()->willReturn(['subaccount' => 'test']);
        $mail->getGlobalMetadata()->willReturn(['meta1' => 'meta1']);
        $mail->getMetadata()->willReturn(['me@dispostable.com' => ['meta2' => 'meta2']]);
        $mail->getGlobalVariables()->willReturn(['var1' => 'var1']);
        $mail->getVariables()->willReturn(['me@dispostable.com' => ['var2' => 'var2']]);
        $mail->getTemplate()->willReturn('template');
        $mail->getTemplateContent()->willReturn(['content1' => 'content1']);
        $mail->getImages()->willReturn([]);
        $mail->getTags()->willReturn(['tag1', 'tag2']);

        return $mail->reveal();
    }

}
