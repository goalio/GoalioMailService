GoalioMailService
================

Version 1.2.0 Created by the goalio UG (haftungsbeschränkt)

Introduction
------------

Provide configurable Mail Transport Factory  and simple messaging for ZF2

Requirements
------------

* [Zend Framework 2](https://github.com/zendframework/zf2) (> 2.3.3).

Features / Goals
----------------

* Configure transport service for using Zend\Mail [COMPLETE]

Changelog
---------
With ZF2.3 the Transport Factory changed. This made changes to the configuration in the goaliomailservice.global.php (and goaliomailservice.local.php) neccessary.
I tried to check this in my own factory, but please be aware of this.

Installation
------------

### Main Setup

#### With composer

1. Add this project and the requirements in your composer.json:

    ```json
    "require": {
        "goalio/goalio-mailservice": "1.*"
    }
    ```

2. Now tell composer to download GoalioMailService by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'GoalioMailService'
        ),
        // ...
    );
    ```
2. Copy the configuration files for local and global from
`./vendor/goalio/goalio-mailservice/config/goaliomailservice.{local,global}.php.dist` to
`./config/autoload/goaliomailservice.{local,global}.php` and change the values as desired.

3. If you are using the FileTransport (for development) create the directory `./data/mail`.

Usage
-----

	// The template used by the PhpRenderer to create the content of the mail
	$viewTemplate = 'module/email/testmail';

	// The ViewModel variables to pass into the renderer
	$value = array('foo' => 'bar');

	$mailService = $this->getServiceManager()->get('goaliomailservice_message');
	$message = $mailService->createTextMessage($from, $to, $subject, $viewTemplate, $values);
	$mailService->send($message);

SMTP Setup
----------

GoalioMailService uses sendmail by default, but you can set it up to use SMTP by putting your information in the config file like this:

    $settings = array(
        'transport_class' => 'Zend\Mail\Transport\Smtp',

        'options_class' => 'Zend\Mail\Transport\SmtpOptions',

        'options' => array(
            'host' => 'smtp.gmail.com',
            'connection_class' => 'login',
            'connection_config' => array(
                'ssl' => 'tls',
                'username' => 'YOUR-USERNAME-HERE@gmail.com',
                'password' => 'YOUR-PASSWORD-HERE'
            ),
            'port' => 587
        )
    );
