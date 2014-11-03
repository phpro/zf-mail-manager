# Mail Manager
This package provides an easy-to-use mail-manager for ZF2 that lets you focus on creating your mails.
Every e-mail is a class that you can configure based on your own needs.
The mail manager uses a configurable mail adapter so that you don't have to worry about sending your mails.

## Installation
```
curl -s https://getcomposer.org/installer | php
php composer.phar install
```

## Module Installation

### Add to composer.json
```
"phpro/zf-mail-manager": "~0.2"
```

### Add module to application.config.php
```php
<?php
return array(
    'modules' => array(
        'Phpro\MailManager',
        // other libs...
    ),
    // Other config
);
```

### Add your custom mail settings
```php
<?php
return array(
    //
    // Define a Default Mailmanager
    //
    'service_manager' => array(
        'aliases' => array(
            'Phpro\MailManager\DefaultAdapter' => 'Phpro\MailManager\Adapter\ZendMailAdapter',
        )
    ),

    //
    // Paths to e-mail templates for renderable e-mail objects.
    //
    'view_manager' => [
        'template_map' => [
            'mails/layout' => __DIR__ . '/../view/mails/layout.phtml',
            'mails/customer/registered' => __DIR__ . '/../view/mails/customer/registered.phtml',
        ],
    ],

    //
    // Custom e-mail plugin manager
    //
    'mail_manager' => [
        'invokables' => [
            'CustomerRegisteredMail' => 'CustomerRegisteredMail',
        ],
    ],
);
```

### Create your own Mail objects
```php
<?php
use MailManager\Mail\Base\ZendMail;

/**
 * Class ShareCollection
 *
 * @package MailManager\Mail
 */
class CustomerRegisteredMail extends ZendMail
{
    protected $viewFile = 'mails/customer/registered';
    protected $subject = 'Customer Registered';
    protected $to = ['me@dispostable.com' => 'Me'];
    protected $from = ['me@dispostable.com' => 'Me'];

    // Custom view parameters
    protected $params = [
        'name' => 'Me',
        'email' => 'me@dispostable.com',
    ];

    // Other settings like headers, attachments, ...
}
```

### Sending your e-mail:
```php
<?php
// Through the mail plugin manager:
$mailManager = $serviceManager->get('Phpro\MailManager');
$mail = $mailManager->get('CustomerRegisteredMail');
$mailManager->send($mail);

// Without the mail plugin manager:
$mailManager = $serviceManager->get('Phpro\MailManager');
$mail = new CustomerRegisteredMail();
$mailManager->send($mail);
```


# Supported adapters
At the moment following adapters are supported:

- ZendMail
- Mandrill
