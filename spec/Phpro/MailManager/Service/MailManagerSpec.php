<?php

namespace spec\Phpro\MailManager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailManagerSpec extends ObjectBehavior
{

    /**
     * @param \Phpro\MailManager\Adapter\AdapterInterface $adapter
     */
    public function let($adapter)
    {
        $this->beConstructedWith($adapter);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\MailManager');
    }

    /**
     * @param \Phpro\MailManager\Adapter\AdapterInterface $adapter
     * @param \Phpro\MailManager\Mail\MailInterface $mail
     */
    public function it_should_send_emails($adapter, $mail)
    {
        $adapter->send($mail)->shouldBeCalled();
        $this->send($mail);
    }

}
