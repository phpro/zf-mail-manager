<?php

namespace spec\Phpro\MailManager\Service\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MailMessageCreatorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Service\Factory\MailMessageCreator');
    }

    public function it_is_a_factory()
    {
        $this->shouldImplement('Zend\ServiceManager\FactoryInterface');
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceManager
     * @param \Phpro\MailManager\Service\BodyRenderer $bodyRenderer
     */
    public function it_should_create_an_instance($serviceManager, $bodyRenderer)
    {
        $serviceManager->get('Phpro\MailManager\Service\BodyRenderer')->willReturn($bodyRenderer);

        $this->createService($serviceManager)->shouldBeAnInstanceOf('Phpro\MailManager\Service\MailMessageCreator');
    }
}
