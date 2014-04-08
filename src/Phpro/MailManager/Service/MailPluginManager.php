<?php

namespace Phpro\MailManager\Service;

use Phpro\MailManager\Mail\MailInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception\RuntimeException;

/**
 * Class TaskPluginManager
 *
 * @package TaskManager\Service
 */
class MailPluginManager extends AbstractPluginManager
{

    /**
     * Whether or not to share by default
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * {@inheritDoc}
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof MailInterface) {
            // we're okay
            return;
        }

        throw new RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement MailInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin))
        ));
    }

}
