<?php

namespace Phpro\MailManager\Adapter\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Phpro\MailManager\Adapter\MandrillMailAdapter as Instance;


/**
 * Class MandrillMailAdapter
 *
 * @package Phpro\MailManager\Adapter\Service\Factory
 */
class MandrillMailAdapter
    implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $transport = $serviceLocator->get('SlmMail\Mail\Transport\MandrillTransport');

        $instance = new Instance($transport);
        return $instance;
    }

}
