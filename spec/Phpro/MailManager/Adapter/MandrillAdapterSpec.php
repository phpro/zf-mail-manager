<?php

namespace spec\Phpro\MailManager\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SlmMail\Mail\Message\Mandrill;
use stub\Phpro\MailManager\Mail\ProvidesMandrillStubSpec;
use stub\Phpro\MailManager\Adapter\ProvidesAdapterInterfaceSpec;

class MandrillAdapterSpec extends ObjectBehavior
{

    use ProvidesAdapterInterfaceSpec;
    use ProvidesMandrillStubSpec;

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
     */
    public function it_should_send_a_mail_with_mandrill_template($transport)
    {
        $mail = $this->getMailStub();
        $transport->send(Argument::that(function ($message) use ($mail) {
            return $message instanceof Mandrill
                && $message->getTo()->has('me@dispostable.com')
                && $message->getCc()->has('me@dispostable.com')
                && $message->getBcc()->has('me@dispostable.com')
                && $message->getFrom()->has('me@dispostable.com')
                && $message->getReplyTo()->has('me@dispostable.com')
                && $message->getSubject() == $mail->getSubject()
                && $message->getOptions() == ['subaccount' => 'test']
                && $message->getGlobalMetadata() == ['meta1' => 'meta1']
                && $message->getMetadata() == ['me@dispostable.com' => ['meta2' => 'meta2']]
                && $message->getGlobalVariables() == ['var1' => 'var1']
                && $message->getVariables() == ['me@dispostable.com' => ['var2' => 'var2']]
                && $message->getTemplate() == 'template'
                && $message->getTemplateContent() == ['content1' => 'content1']
                && $message->getImages() == []
                && $message->getTags() == ['tag1', 'tag2'];
        }))->shouldBeCalled();

        $this->send($mail);
    }

    /**
     * @param \Zend\Mail\Transport\TransportInterface $transport
     * @param \Phpro\MailManager\Service\MailMessageCreator $messageCreator
     * @param \Zend\Mime\Message $mailMessage
     */
    public function it_should_send_a_mail_with_zend_view_renderer($transport, $messageCreator, $mailMessage)
    {
        $mail = $this->getRenderableMailStub();
        $messageCreator->createMessage($mail)->willReturn($mailMessage);

        $transport->send(Argument::that(function ($message) use ($mail, $mailMessage) {
            return $message instanceof Mandrill
                && $message->getTo()->has('me@dispostable.com')
                && $message->getCc()->has('me@dispostable.com')
                && $message->getBcc()->has('me@dispostable.com')
                && $message->getFrom()->has('me@dispostable.com')
                && $message->getReplyTo()->has('me@dispostable.com')
                && $message->getSubject() == $mail->getSubject()
                && $message->getOptions() == ['subaccount' => 'test']
                && $message->getImages() == []
                && $message->getTags() == ['tag1', 'tag2']
                && $message->getBody() == $mailMessage->getWrappedObject();
            }))->shouldBeCalled();

        $this->send($mail);
    }
}
