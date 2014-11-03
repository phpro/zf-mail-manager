<?php

namespace spec\Phpro\MailManager\Mail\Base;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ZendMailSpec extends MailSpec
{

    public function it_is_a_zend_mail_object()
    {
        $this->shouldImplement('Phpro\MailManager\Mail\ZendMailInterface');
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

}
