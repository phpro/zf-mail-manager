<?php

namespace Phpro\MailManager\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Phpro\MailManager\Service\MailManager as Instance;

/**
 * Class MailManager
 *
 * @package Phpro\MailManager\Service\Factory
 */
class MailManager
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
        $pluginManager = $serviceLocator->get('Phpro\MailManager\PluginManager');
        $adapter = $serviceLocator->get('Phpro\MailManager\DefaultAdapter');

        $instance = new Instance($pluginManager, $adapter);
        return $instance;
    }
}
