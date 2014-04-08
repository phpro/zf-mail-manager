<?php

namespace Phpro\MailManager\Service\Factory;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

/**
 * Class TaskPluginManager
 *
 * @package TaskManager\Service\Factory
 */
class MailPluginManager extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'Phpro\MailManager\Service\MailPluginManager';
}
