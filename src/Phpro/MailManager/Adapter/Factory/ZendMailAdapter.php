<?php

namespace Phpro\MailManager\Adapter\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mail;
use Phpro\MailManager\Adapter\ZendMailAdapter as Instance;

/**
 * Class ZendMailAdapter
 *
 * @package Phpro\MailManager\Adapter\Service\Factory
 */
class ZendMailAdapter
    implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // Todo: make transport configurable
        $transport = new Mail\Transport\Sendmail();
        $messageCreator = $serviceLocator->get('Phpro\MailManager\Service\MailMessageCreator');

        $instance = new Instance($transport, $messageCreator);
        return $instance;
    }
}
