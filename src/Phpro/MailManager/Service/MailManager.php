<?php

namespace Phpro\MailManager\Service;
use Phpro\MailManager\Adapter\AdapterInterface;
use Phpro\MailManager\Mail\MailInterface;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MailManager
 *
 * @package Phpro\MailManager\Service
 */
class MailManager
    implements ServiceLocatorInterface
{

    /**
     * @var MailPluginManager
     */
    protected $pluginManager;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @param $pluginmanager
     * @param $adapter
     */
    public function __construct($pluginmanager, $adapter)
    {
        $this->pluginManager = $pluginmanager;
        $this->adapter = $adapter;
    }

    /**
     * Retrieve a registered instance
     *
     * @param  string $name
     *
     * @throws Exception\ServiceNotFoundException
     * @return object|array
     */
    public function get($name)
    {
        return $this->pluginManager->get($name);
    }

    /**
     * Check for a registered instance
     *
     * @param  string|array $name
     *
     * @return bool
     */
    public function has($name)
    {
        return $this->pluginManager->has($name);
    }


    /**
     * @param MailInterface $mail
     */
    public function send(MailInterface $mail)
    {
        $this->adapter->send($mail);
    }

}
