<?php

namespace Phpro\MailManager\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Phpro\MailManager\Service\BodyRenderer as Instance;

/**
 * Class SendMail
 *
 * @package Phpro\MailManager\Service\Factory
 */
class BodyRenderer
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
        $viewRenderer = $serviceLocator->get('viewrenderer');

        $instance = new Instance($viewRenderer);
        return $instance;
    }

}
