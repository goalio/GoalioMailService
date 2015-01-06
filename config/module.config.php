<?php
return array(

    'service_manager' => array(
        'aliases' => array(
            // For backwards compatibility
            'goaliomailservice_message'          => 'GoalioMailService\Mailer',
        ),
        'factories' => array(
            'GoalioMailService\MailRenderer'     => 'GoalioMailService\View\Service\MailRendererFactory',
            'GoalioMailService\MailStrategy'     => 'GoalioMailService\View\Service\MailStrategyFactory',

            'GoalioMailService\Mailer'           => 'GoalioMailService\Mail\Service\MailerFactory',
            'GoalioMailService\TransportManager' => 'GoalioMailService\Mail\Service\TransportManagerFactory',
            'GoalioMailService\Transport'        => 'GoalioMailService\Mail\Service\TransportFactory',
        ),
    ),

    'mail_transports' => array(
        'abstract_factories' => array(
            'GoalioMailService\Mail\Transport\Factory',
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'mail'     => __DIR__ . '/../view/layout/mail.phtml',
        ),

        'strategies' => array(
            'GoalioMailService\MailStrategy',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'mail' => 'GoalioMailService\View\Helper\Mail',
        ),
    ),
);