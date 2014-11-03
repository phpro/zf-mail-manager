<?php

namespace spec\Phpro\MailManager\Mail\Stub;


use Prophecy\Prophet;

trait ProvidesRenderableMailStubSpec
{

    /**
     * @return \Phpro\MailManager\Mail\RenderableMailInterface
     */
    protected function getMailStub()
    {
        $prophet = new Prophet();

        /** @var \Phpro\MailManager\Mail\RenderableMailInterface $mail */
        $mail = $prophet->prophesize('Phpro\MailManager\Mail\RenderableMailInterface');

        $mail->getParams()->willReturn(['param1' => 'value1']);
        $mail->getViewFile()->willReturn('view-file');
        $mail->getLayoutFile()->willReturn('layout-file');

        return $mail->reveal();
    }

}
