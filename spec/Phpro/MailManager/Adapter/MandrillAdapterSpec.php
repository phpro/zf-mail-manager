<?php

namespace spec\Phpro\MailManager\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SlmMail\Mail\Message\Mandrill;
use spec\Phpro\MailManager\Mail\Stub\ProvidesMandrillStubSpec;

class MandrillAdapterSpec extends ObjectBehavior
{

    use ProvidesAdapterInterfaceSpec;
    use ProvidesMandrillStubSpec;

    /**
     *
     * @param \Zend\Mail\Transport\TransportInterface $transport
     */
    public function let($transport)
    {
        $this->beConstructedWith($transport);
    }

    /**
     * @param \Zend\Mail\Transport\TransportInterface $transport
     */
    public function it_should_send_a_mail($transport)
    {
        $mail = $this->getMailStub();
        $transport->send(Argument::that(function ($message) use ($mail) {
            return $message instanceof Mandrill
                && $message->getTo()->has('me@dispostable.com')
                && $message->getCc()->has('me@dispostable.com')
                && $message->getBcc()->has('me@dispostable.com')
                && $message->getFrom()->has('me@dispostable.com')
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

}
