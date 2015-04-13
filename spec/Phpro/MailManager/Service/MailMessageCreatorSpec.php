<?php

namespace spec\Phpro\MailManager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stub\Phpro\MailManager\Mail\ProvidesRenderableMailStubSpec;

class MailMessageCreatorSpec extends ObjectBehavior
{

    use ProvidesRenderableMailStubSpec;

    /**
     * @param \Phpro\MailManager\Service\BodyRenderer $bodyRenderer
     */
    public function let($bodyRenderer)
    {
        $this->beConstructedWith($bodyRenderer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\MailMessageCreator');
    }

    /**
     * @param \Phpro\MailManager\Service\BodyRenderer $bodyRenderer
     */
    public function it_should_create_a_mail_message($bodyRenderer)
    {
        $mail = $this->getMailStub();
        $bodyRenderer->render($mail)->willReturn('<html></html>');
        $message = $this->createMessage($mail);

        $message->getParts()[0]->getContent()->shouldBe('<html></html>');
    }
}
