<?php

namespace spec\Phpro\MailManager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailManagerSpec extends ObjectBehavior
{

    /**
     * @param \Phpro\MailManager\Service\MailPluginManager $pluginManager
     * @param \Phpro\MailManager\Adapter\AdapterInterface $adapter
     */
    public function let($pluginManager, $adapter)
    {
        $this->beConstructedWith($pluginManager, $adapter);
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
        $adapter->canSend($mail)->willReturn(true);
        $adapter->send($mail)->shouldBeCalled();
        $this->send($mail);
    }

    /**
     * @param \Phpro\MailManager\Adapter\AdapterInterface $adapter
     * @param \Phpro\MailManager\Mail\MailInterface $mail
     */
    public function it_should_not_send_unsupported_mails($adapter, $mail)
    {
        $adapter->canSend($mail)->willReturn(false);
        $this->shouldThrow('RuntimeException')->duringSend($mail);
    }
}
