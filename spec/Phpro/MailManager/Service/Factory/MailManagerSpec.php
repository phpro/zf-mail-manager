<?php

namespace spec\Phpro\MailManager\Service\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailManagerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\Factory\MailManager');
    }

    public function it_is_a_factory()
    {
        $this->shouldImplement('Zend\ServiceManager\FactoryInterface');
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceManager
     * @param \Phpro\MailManager\Service\MailPluginManager $pluginManager
     * @param \Phpro\MailManager\Adapter\AdapterInterface $adapter
     */
    public function it_should_create_an_instance($serviceManager, $pluginManager, $adapter)
    {
        $serviceManager->get('Phpro\MailManager\PluginManager')->willReturn($pluginManager);
        $serviceManager->get('Phpro\MailManager\DefaultAdapter')->willReturn($adapter);

        $this->createService($serviceManager)->shouldBeAnInstanceOf('Phpro\MailManager\Service\MailManager');
    }
}
