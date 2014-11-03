<?php

namespace spec\Phpro\MailManager\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SlmMail\Mail\Message\Mandrill;
use spec\Phpro\MailManager\Mail\Stub\ProvidesMandrillMailStubSpec;

class MandrillMailAdapterSpec extends ObjectBehavior
{

    use ProvidesAdapterInterfaceSpec;
    use ProvidesMandrillMailStubSpec;

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

    /*
     *
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
     */



    protected function createMessage(MandrillMailInterface $mail)
    {
        $message = new Mandrill();
        $message->getHeaders()->addHeaders($mail->getHeaders());
        $message->setTo($mail->getTo());
        $message->setCc($mail->getCc());
        $message->setBcc($mail->getBcc());

        if ($mail->getFrom()) {
            $message->setFrom($mail->getFrom());
        }

        if ($mail->getSubject()) {
            $message->setSubject($mail->getSubject());
        }

        $message->setOptions($mail->getOptions());
        $message->setTags($mail->getTags());
        $message->setTemplate($mail->getTemplate());
        $message->setTemplateContent($mail->getTemplateContent());
        $message->setGlobalVariables($mail->getGlobalVariables());
        $message->setGlobalMetadata($mail->getGlobalMetadata());
        $message->setImages($mail->getImages());

        if ($mail->getVariables()) {
            foreach ($mail->getVariables() as $recipient => $variables) {
                $message->setVariables($recipient, $variables);
            }
        }

        if ($mail->getMetadata()) {
            foreach ($mail->getMetadata() as $recipient => $metadata) {
                $message->setMetadata($recipient, $metadata);
            }
        }

        return $message;
    }


}
