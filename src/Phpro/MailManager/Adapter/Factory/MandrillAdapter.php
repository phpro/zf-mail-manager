<?php

namespace Phpro\MailManager\Adapter\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Phpro\MailManager\Adapter\MandrillAdapter as Instance;

/**
 * Class MandrillAdapter
 *
 * @package Phpro\MailManager\Adapter\Service\Factory
 */
class MandrillAdapter
    implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $transport = $serviceLocator->get('SlmMail\Mail\Transport\MandrillTransport');
        $messageCreator = $serviceLocator->get('Phpro\MailManager\Service\MailMessageCreator');

        $instance = new Instance($transport, $messageCreator);
        return $instance;
    }
}
