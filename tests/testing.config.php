<?php
return array(
    'service_manager' => array(
        'shared' => array(
            'goaliomailservice_message'   => false
        ),
        'invokables' => array(
            'goaliomailservice_message'   => 'GoalioMailService\Mail\Service\Message',
        ),
        'factories' => array(
            'goaliomailservice_options'   => 'GoalioMailService\Mail\Options\Service\TransportOptionsFactory',
            'goaliomailservice_transport' => 'GoalioMailService\Mail\Transport\Service\TransportFactory',
            'goaliomailservice_renderer'  => 'GoalioMailService\Mail\View\MailPhpRendererFactory',
        ),
    ),
);