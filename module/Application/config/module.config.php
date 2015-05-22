<?php
/**
 * Sales and Orders Ads (http://salesandordersads.com/)
 *
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 *
 * @link      https://github.com/SalesAndOrders/Admin for the canonical source repository
 * @copyright Copyright (c) 2013-2015 New Dynamx Inc. (http://www.salesandorders.com)
 * @license   See LICENSE.txt
 */

$date = new \DateTime();
return [
    'controllers' => [
        'initializers' => [
            'Application\LogInitializer',
        ],
        'invokables' => [
            'Application\Controller\UI' => 'Application\Controller\UIController',
        ]
    ],

    'router' => [
        'routes' => [
            'admin' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\UI',
                        'action'     => 'index'
                    ]
                ]
            ],
        ]
    ],

    'service_manager' => [
        'initializers' => [
            'Application\LogInitializer',
        ],

        'factories' => [
            'Zend\Session\Config\ConfigInterface'   => 'Zend\Session\Service\SessionConfigFactory',
            'Zend\Session\Storage\StorageInterface' => 'Zend\Session\Service\StorageFactory',
            'Zend\Session\SessionManager'           => 'Zend\Session\Service\SessionManagerFactory',
        ],

        'abstract_factories' => [
            'Zend\Session\Service\ContainerAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        ],

        'invokables' => [
            'JsonSchema\Validator'
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_path_stack'      => [__DIR__ . '/../view'],
        'strategies'               => ['ViewJsonStrategy', 'ViewFeedStrategy'],
        'template_map'             => [
            'application/user-interface/index' => __DIR__ . '/../view/app.phtml',
            'error/404'                        => __DIR__ . '/../view/error/404.phtml',
            'error/custom-403'                 => __DIR__ . '/../view/error/403.phtml',
            'error/index'                      => __DIR__ . '/../view/error/index.phtml',
        ]
    ]
];
