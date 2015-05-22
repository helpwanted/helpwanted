<?php

return [
    'log' => [
        'Log\App' => [
            'writers' => [
                [
                    'name'     => 'syslog',
                    'priority' => 1000,
                    'options'  => [
                        'application' => 'helpwanted',
                        'formatter' => [
                            'name' => 'simple',
                            'options' => [
                                'format' => '%priorityName%: %message% -- %extra%'
                            ]
                        ],
                        
                    ]
                ]
            ]
        ]
    ],

    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [__DIR__ . '/../../build/frontend']
        ]
    ],

    'session_manager' => [
        'name' => 'HELPWANTED',
        'validators' => [
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent'
        ]
    ],

    'session_config' => [
        'remember_me_seconds' => 1800,
        'name'                => 'helpwanted',
        'cookie_secure'       => true
    ],

    'session_storage' => [
        'type' => 'SessionArrayStorage',
        'options' => []
    ],

    'session_containers' => [
        'Account',
    ],
];
