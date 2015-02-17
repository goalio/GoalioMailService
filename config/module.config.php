<?php
return array(

    'goalio-mail' => array(
        'layout_html' => 'mail/html',
    ),

    'service_manager' => array(
        'aliases' => array(
            'MailManager'                        => 'GoalioMailService\MailManager',

            // For backwards compatibility
            'goaliomailservice_message'          => 'GoalioMailService\MailManager',
        ),
        'factories' => array(
            'GoalioMailService\MailRenderer'     => 'GoalioMailService\View\Service\MailRendererFactory',
            'GoalioMailService\MailStrategy'     => 'GoalioMailService\View\Service\MailStrategyFactory',

            'GoalioMailService\MailManager'      => 'GoalioMailService\Mail\Service\MailManagerFactory',
            'GoalioMailService\TransportManager' => 'GoalioMailService\Mail\Service\TransportManagerFactory',
            'GoalioMailService\Transport'        => 'GoalioMailService\Mail\Service\TransportFactory',
        ),
    ),

    'mail_transports' => array(
        'abstract_factories' => array(
            'GoalioMailService\Mail\Transport\Factory',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'mail' => 'GoalioMailService\View\Helper\Mail',
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'mail/html'     => __DIR__ . '/../view/layout/html.phtml',
        ),
    ),


);