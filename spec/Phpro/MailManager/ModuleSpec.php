<?php

namespace spec\Phpro\MailManager;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModuleSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Module');
    }

    public function it_should_implement_autoloader_provider_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\AutoloaderProviderInterface');
    }

    public function it_should_implement_config_provider_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\ConfigProviderInterface');
    }

    public function it_should_implement_module_provider_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\InitProviderInterface');
    }

    public function it_should_load_config()
    {
        $this->getConfig()->shouldBeArray();
    }

    public function it_should_load_autoloader_config()
    {
        $this->getAutoloaderConfig()->shouldBeArray();
    }

    /**
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     * @param \Zend\ModuleManager\ModuleEvent $event
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @param \Zend\ModuleManager\Listener\ServiceListenerInterface $serviceListener
     */
    public function it_should_add_the_mailmanager_as_service_plugin_manager($moduleManager, $event, $serviceManager, $serviceListener)
    {
        $moduleManager->getEvent()->willReturn($event);
        $event->getParam('ServiceManager')->willReturn($serviceManager);
        $serviceManager->get('ServiceListener')->willReturn($serviceListener);
        $serviceListener->addServiceManager('Phpro\MailManager\PluginManager', Argument::cetera())->shouldBeCalled();

        $this->init($moduleManager);
    }
}
