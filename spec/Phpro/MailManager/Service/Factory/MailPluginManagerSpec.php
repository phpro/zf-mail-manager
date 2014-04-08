<?php

namespace spec\Phpro\MailManager\Service\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailPluginManagerSpec extends ObjectBehavior
{

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\Factory\MailPluginManager');
    }

    public function it_is_a_abstract_plugin_manager_factory()
    {
        $this->shouldHaveType('Zend\Mvc\Service\AbstractPluginManagerFactory');
    }

}
