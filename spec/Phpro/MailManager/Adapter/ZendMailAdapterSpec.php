<?php

namespace spec\Phpro\MailManager\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stub\Phpro\MailManager\Adapter\ProvidesAdapterInterfaceSpec;
use stub\Phpro\MailManager\Mail\ProvidesZendMailStubSpec;

class ZendMailAdapterSpec extends ObjectBehavior
{

    use ProvidesAdapterInterfaceSpec;
    use ProvidesZendMailStubSpec;

    /**
     *
     * @param \Zend\Mail\Transport\TransportInterface $transport
     * @param \Phpro\MailManager\Service\MailMessageCreator $messageCreator
     */
    public function let($transport, $messageCreator)
    {
        $this->beConstructedWith($transport, $messageCreator);
    }

    /**
     * @param \Zend\Mail\Transport\TransportInterface $transport
     * @param \Phpro\MailManager\Service\MailMessageCreator $messageCreator
     * @param \Zend\Mime\Message $mailMessage
     */
    public function it_should_send_a_mail($transport, $messageCreator, $mailMessage)
    {
        $mail = $this->getMailStub();
        $messageCreator->createMessage($mail)->willReturn($mailMessage);
        $transport->send(Argument::that(function ($message) use ($mail, $mailMessage) {
            return $message->getBody() == $mailMessage->getWrappedObject()
                && $message->getTo()->has('me@dispostable.com')
                && $message->getCc()->has('me@dispostable.com')
                && $message->getBcc()->has('me@dispostable.com')
                && $message->getFrom()->has('me@dispostable.com')
                && $message->getReplyTo()->has('me@dispostable.com')
                && $message->getSubject() == $mail->getSubject();
        }))->shouldBeCalled();

        $this->send($mail);
    }
}
