<?php

namespace spec\Phpro\MailManager\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Phpro\MailManager\Mail\Stub\ProvidesMailStubSpec;

class ZendMailAdapterSpec extends ObjectBehavior
{

    use ProvidesAdapterInterfaceSpec;
    use ProvidesMailStubSpec;

    /**
     *
     * @param \Zend\Mail\Transport\TransportInterface $transport
     * @param \Phpro\MailManager\Service\BodyRenderer $bodyRenderer
     */
    public function let($transport, $bodyRenderer)
    {
        $this->beConstructedWith($transport, $bodyRenderer);
    }

    /**
     * @param \Zend\Mail\Transport\TransportInterface $transport
     * @param \Phpro\MailManager\Service\BodyRenderer $bodyRenderer
     */
    public function it_should_send_a_mail($transport, $bodyRenderer)
    {
        $mail = $this->getMailStub();
        $content = '<html></html>';
        $bodyRenderer->render($mail)->willReturn($content);
        $transport->send(Argument::that(function ($message) use ($mail, $content) {

            $body = $message->getBody();
            $parts = $body->getParts();

            return $parts[0]->getRawContent() == $content
                && $parts[0]->type == 'text/html'
                && $parts[1]->getRawContent() == '/tmp/file.txt'
                && $parts[1]->id == 'name'
                && $parts[1]->filename == 'name'
                && $message->getTo()->has('me@dispostable.com')
                && $message->getCc()->has('me@dispostable.com')
                && $message->getBcc()->has('me@dispostable.com')
                && $message->getFrom()->has('me@dispostable.com')
                && $message->getSubject() == $mail->getSubject();
        }))->shouldBeCalled();

        $this->send($mail);
    }
}
