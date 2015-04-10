<?php

namespace Phpro\MailManager\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Phpro\MailManager\Service\MailMessageCreator as Instance;

/**
 * Class SendMail
 *
 * @package Phpro\MailManager\Service\Factory
 */
class MailMessageCreator
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
        $bodyRenderer = $serviceLocator->get('Phpro\MailManager\Service\BodyRenderer');
        $instance = new Instance($bodyRenderer);
        return $instance;
    }
}
