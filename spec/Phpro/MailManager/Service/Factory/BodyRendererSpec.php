<?php

namespace spec\Phpro\MailManager\Service\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BodyRendererSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\Factory\BodyRenderer');
    }

    public function it_is_a_factory()
    {
        $this->shouldImplement('Zend\ServiceManager\FactoryInterface');
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceManager
     * @param \Zend\View\Renderer\RendererInterface $viewRenderer
     */
    public function it_should_create_an_instance($serviceManager, $viewRenderer)
    {
        $serviceManager->get('viewrenderer')->willReturn($viewRenderer);

        $this->createService($serviceManager)->shouldBeAnInstanceOf('Phpro\MailManager\Service\BodyRenderer');
    }
}
