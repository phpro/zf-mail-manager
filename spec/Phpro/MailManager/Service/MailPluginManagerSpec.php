<?php

namespace spec\Phpro\MailManager\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailPluginManagerSpec extends ObjectBehavior
{
    /**
     * @param \Zend\ServiceManager\ConfigInterface $configuration
     */
    public function let($configuration)
    {
        $this->beConstructedWith($configuration);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\MailPluginManager');
    }

    public function it_is_an_abstract_plugin_manager()
    {
        $this->shouldHaveType('Zend\ServiceManager\AbstractPluginManager');
    }

    /**
     * @param \Phpro\MailManager\Mail\MailInterface $plugin
     * @param \stdClass $invalid
     */
    public function it_should_validate_loaded_instace($plugin, $invalid)
    {
        $this->shouldNotThrow()->duringValidatePlugin($plugin);
        $this->shouldThrow('\Zend\ServiceManager\Exception\RuntimeException')->duringValidatePlugin($invalid);
    }
}
