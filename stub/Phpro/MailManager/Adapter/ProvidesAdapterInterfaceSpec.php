<?php

namespace stub\Phpro\MailManager\Adapter;

trait ProvidesAdapterInterfaceSpec
{
    public function it_is_initializable()
    {
        $this->shouldImplement('Phpro\MailManager\Adapter\AdapterInterface');
    }
}
