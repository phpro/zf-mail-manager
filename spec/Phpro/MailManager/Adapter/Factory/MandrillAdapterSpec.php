<?php

namespace spec\Phpro\MailManager\Adapter\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MandrillAdapterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\MailManager\Adapter\Factory\MandrillAdapter');
    }

    public function it_is_a_factory()
    {
        $this->shouldImplement('Zend\ServiceManager\FactoryInterface');
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceManager
     * @param \Zend\Mail\Transport\TransportInterface $transport
     * @param \Phpro\MailManager\Service\MailMessageCreator $messageCreator
     */
    public function it_should_create_an_instance($serviceManager, $transport, $messageCreator)
    {
        $serviceManager->get('SlmMail\Mail\Transport\MandrillTransport')->willReturn($transport);
        $serviceManager->get('Phpro\MailManager\Service\MailMessageCreator')->willReturn($messageCreator);

        $this->createService($serviceManager)->shouldBeAnInstanceOf('Phpro\MailManager\Adapter\MandrillAdapter');
    }
}
