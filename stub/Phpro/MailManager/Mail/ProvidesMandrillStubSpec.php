<?php

namespace stub\Phpro\MailManager\Mail;

use Prophecy\Prophet;

trait ProvidesMandrillStubSpec
{

    /**
     * @return \Phpro\MailManager\Mail\MandrillInterface
     */
    protected function createEmptyMailStub()
    {
        $prophet = new Prophet();

        /** @var \Phpro\MailManager\Mail\MandrillInterface $mail */
        $mail = $prophet->prophesize('Phpro\MailManager\Mail\MandrillInterface');
        $headers = $prophet->prophesize('Zend\Mail\Headers');

        $mail->getTo()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getCc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getBcc()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getFrom()->willReturn(['me@dispostable.com' => 'me']);
        $mail->getSubject()->willReturn('Subject');

        $mail->getHeaders()->willReturn($headers);
        $mail->getAttachments()->willReturn(['name' => '/tmp/file.txt']);

        $mail->getOptions()->willReturn(['subaccount' => 'test']);
        $mail->getImages()->willReturn([]);
        $mail->getTags()->willReturn(['tag1', 'tag2']);
        $mail->getGlobalMetadata()->willReturn(['meta1' => 'meta1']);
        $mail->getMetadata()->willReturn(['me@dispostable.com' => ['meta2' => 'meta2']]);

        return $mail;
    }

    /**
     * @return \Phpro\MailManager\Mail\MailInterface
     */
    protected function getMailStub()
    {
        $mail = $this->createEmptyMailStub();
        $mail->useMandrillTemplate()->willReturn(true);
        $mail->getGlobalVariables()->willReturn(['var1' => 'var1']);
        $mail->getVariables()->willReturn(['me@dispostable.com' => ['var2' => 'var2']]);
        $mail->getTemplate()->willReturn('template');
        $mail->getTemplateContent()->willReturn(['content1' => 'content1']);
        return $mail->reveal();
    }

    /**
     * @return \Phpro\MailManager\Mail\MailInterface
     */
    protected function getRenderableMailStub()
    {
        $mail = $this->createEmptyMailStub();
        $mail->useMandrillTemplate()->willReturn(false);
        $mail->getLayoutFile()->willReturn('layout');
        $mail->getViewFile()->willReturn('view');
        $mail->getParams()->willReturn(['param1' => 'value1']);
        return $mail->reveal();
    }
}
