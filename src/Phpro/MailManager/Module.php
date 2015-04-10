<?php
namespace Phpro\MailManager;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

/**
 * Class Module
 *
 * @package Tenant
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    InitProviderInterface
{
    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../../' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Initialize workflow
     *
     * @param  ModuleManagerInterface $moduleManager
     *
     * @return void
     */
    public function init(ModuleManagerInterface $moduleManager)
    {
        $serviceManager = $moduleManager->getEvent()->getParam('ServiceManager');
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            'Phpro\MailManager\PluginManager',
            'mail_manager',
            'Phpro\MailManager\Mail\MailInterface',
            'getMailManagerConfig'
        );
    }
}
