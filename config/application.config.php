<?php

return [
    'modules' => [
        'Account',
        'Application',
        'Bucket',
        'Campaign',
        'Channel',
        'Cron',
        'Dashboard',
        'Google',
        'Invite',
        'Job',
        'Panel',
        'Filter',
        'Product',
        'Security',
        'Recent',
        'Signup',
        'User',
        'Mongo',

        'AssetManager',
        'ZfcRbac',
        'ZF\Apigility',
        'ZF\Apigility\Provider',
        'ZF\Apigility\Documentation',
        'ZF\ApiProblem',
        'ZF\MvcAuth',
        'ZF\OAuth2',
        'ZF\Hal',
        'ZF\ContentNegotiation',
        'ZF\ContentValidation',
        'ZF\Rest',
        'ZF\Rpc',
        'ZF\Versioning',
        'Mailing',
    ],

    'module_listener_options' => [
        'config_glob_paths'    => [
            dirname(__DIR__) . '/config/autoload/{,*.}{global,local}.php'
        ],

        'config_cache_enabled' => isset($_SERVER['HTTP_HOST']) && !is_null($_SERVER['HTTP_HOST']),

        'config_cache_key' => 'sando',

        'module_map_cache_enabled' => true,

        'module_map_cache_key' => 'sando_map',

        'cache_dir' => dirname(__DIR__) . '/data/cache',

        'module_paths' => [
            dirname(__DIR__) . '/module',
            dirname(__DIR__) . '/vendor'
        ]
    ]
];
