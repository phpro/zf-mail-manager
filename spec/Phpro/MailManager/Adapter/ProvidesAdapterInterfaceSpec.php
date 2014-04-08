<?php

namespace spec\Phpro\MailManager\Adapter;

trait ProvidesAdapterInterfaceSpec
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Adapter\ZendMailAdapter');
    }
}
