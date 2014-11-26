<?php
return array(

    'service_manager' => array(
        'shared' => array(
            'goaliomailservice\message'   => false
        ),
        'invokables' => array(
            'goaliomailservice\message'   => 'GoalioMailService\Mail\Message',
        ),
        'factories' => array(
            'goaliomailservice\transportmanager' => 'GoalioMailService\Mail\Service\TransportManagerFactory',
            'goaliomailservice\transport'        => 'GoalioMailService\Mail\Service\TransportFactory',
            'goaliomailservice\renderer'         => 'GoalioMailService\Mail\View\MailPhpRendererFactory',
        ),
    ),

    'mail_transports' => array(
        'abstract_factories' => array(
            'GoalioMailService\Mail\Transport\Factory',
        )
    )

);