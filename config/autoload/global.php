<?php

return [
    'log' => [
        'Log\App' => [
            'writers' => [
                [
                    'name'     => 'syslog',
                    'priority' => 1000,
                    'options'  => [
                        'application' => 'sando_v3',
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
            'paths' => [__DIR__ . '/../../asset/dist/ads-admin']
        ]
    ],

    'ads-google' => [
        'scope' => [
            'analytics' => 'https://www.googleapis.com/auth/analytics.readonly',
            'adwords'   => 'https://www.googleapis.com/auth/adwords',
            'merchant'  => 'https://www.googleapis.com/auth/structuredcontent'
        ],
        'auth_uri'        => 'https://accounts.google.com/o/oauth2/auth',
        'token_uri'       => 'https://accounts.google.com/o/oauth2/token',
        'info_uri'        => 'https://www.googleapis.com/oauth2/v1/userinfo',
        'user_agent'      => 'SandO',
    ],

    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo'
            ]
        ]
    ],

    'mail' => [
        'domains' => ['default' => 'www.salesandorders.com'],

        'from' => [
            'default' => [
                'name'   => 'Sales And Orders',
                'email'  => 'noreply@salesandorders.com',
                'domain' => 'default'
            ]
        ],

        'mails' => [
            'invite_email' => [
                'template' => ['html' => 'invite_email'],
                'from'     => "default",
                'subject'  => "You have been invited to Sales and Orders"
            ],

            'added_user' => [
                'template' => ['html' => 'added_user'],
                'from'     => "default",
                'subject'  => "You have been added to a new account in Sales and Orders"
            ],

            'forgot_password' => [
                'template' => [
                    'html' => 'forgot_password'
                ],
                'from' => "default",
                'subject' => "Reset password for Sales And Orders"
            ],

            'reset_password' => [
                'template' => [
                    'html' => 'reset_password'
                ],
                'from' => "default",
                'subject' => "Password was reset for Sales And Orders"
            ],

            'trial_account_added' => [
                'template' => [
                    'html' => 'trial_account_added'
                ],
                'from' => "default",
                'subject' => "Trial account created"
            ],

            'trial_account_created' => [
                'template' => [
                    'html' => 'trial_account_created'
                ],
                'from' => "default",
                'subject' => "A new trial has signed up for Sales & Orders"
            ],

            'invite_super_user' => [
                'template' => [
                    'html' => 'invite_super_user'
                ],
                'from' => "default",
                'subject' => "Sales and Orders super user invitation"
            ],

            'new_trial_signup' => [
                'template' => [
                    'html' => 'new_trial_signup'
                ],
                'from' => "default",
                'subject' => "New account for trial create"
            ]
        ]
    ],

    'session_manager' => [
        'name' => 'SALESANDORDERS',
        'validators' => [
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent'
        ]
    ],

    'session_config' => [
        'remember_me_seconds' => 1800,
        'name'                => 'sales_and_orders',
        'cookie_secure'       => true
    ],

    'session_storage' => [
        'type' => 'SessionArrayStorage',
        'options' => []
    ],

    'session_containers' => [
        'Account',
    ],

    'caches' => [
        'memcached' => [
            'adapter' => [
                'name' => 'memcached',
                'options' => [
                    'namespace' => 'SANDO',
                    'liboptions' => [
                        'COMPRESSION' => true,
                        'binary_protocol' => true,
                        'no_block' => true,
                        'connect_timeout' => 100
                    ]
                ],
            ],
            'plugins' => [
                'exception_handler' => [
                    'throw_exceptions' => false,
                ],
            ],
        ],
    ],
];
