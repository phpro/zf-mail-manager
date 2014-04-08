<?php

namespace spec\Phpro\MailManager\Mail;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultMailSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Mail\DefaultMail');
    }

    public function it_is_a_mail_object()
    {
        $this->shouldImplement('Phpro\MailManager\Mail\MailInterface');
    }

    public function it_should_provide_to_addresses()
    {
        $this->addTo('me@email.com', 'name');
        $this->addTo('you@email.com');

        $result = $this->getTo();
        $result['me@email.com']->shouldBe('name');
        $result[0]->shouldBe('you@email.com');
    }

    public function it_should_provide_cc_addresses()
    {
        $this->addCc('me@email.com', 'name');
        $this->addCc('you@email.com');

        $result = $this->getCc();
        $result['me@email.com']->shouldBe('name');
        $result[0]->shouldBe('you@email.com');
    }

    public function it_should_provide_bcc_addresses()
    {
        $this->addBcc('me@email.com', 'name');
        $this->addBcc('you@email.com');

        $result = $this->getBcc();
        $result['me@email.com']->shouldBe('name');
        $result[0]->shouldBe('you@email.com');
    }

    public function it_should_provide_a_from_addresses()
    {
        $this->setFrom('me@email.com', 'name');
        $this->getFrom()['me@email.com']->shouldBe('name');

        $this->setFrom('me@email.com');
        $result = $this->getFrom();
        $result[0]->shouldBe('me@email.com');
        $result->shouldHaveCount(1);
    }

    public function it_should_provide_a_subject()
    {
        $value = 'subject';
        $this->setSubject($value);
        $this->getSubject()->shouldBe($value);
    }

    public function it_should_provide_a_view_file()
    {
        $value = 'view-file';
        $this->setViewFile($value);
        $this->getViewFile()->shouldBe($value);
    }

    public function it_should_provide_a_layout_file()
    {
        $value = 'layout-file';
        $this->setLayoutFile($value);
        $this->getLayoutFile()->shouldBe($value);
    }

    public function it_should_provide_view_params()
    {
        $this->addParam('param1', 'value1');
        $this->addParam('param2', 'value2');

        $result = $this->getParams();
        $result['param1']->shouldBe('value1');
        $result['param2']->shouldBe('value2');
    }

    public function it_should_provide_attachments()
    {
        $this->addAttachment('/tmp/file1.txt', 'renamed.txt');
        $this->addAttachment('/tmp/file2.txt');

        $result = $this->getAttachments();
        $result['renamed.txt']->shouldBe('/tmp/file1.txt');
        $result['file2.txt']->shouldBe('/tmp/file2.txt');
    }

    /**
     * @param Zend\Mail\Header\HeaderInterface $header
     */
    public function it_should_provide_headers($header)
    {
        $header->getFieldName()->willReturn('Reply-To');
        $header->getFieldValue()->willReturn('me@dispostable.com');

        $this->addHeader($header);
        $this->addHeaders(['Content-Type' => 'text/html']);

        $result = $this->getHeaders()->toArray();
        $result['Reply-To']->shouldBe('me@dispostable.com');
        $result['Content-Type']->shouldBe('text/html');
    }

}
