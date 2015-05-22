<?php
return [
    'router' => [
        'routes' => [
            'api.rest.project' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/api/project[/:service][/:user][/:project]',
                    'defaults' => ['controller' => 'Api\V1\Rest\Project\Controller']
                ]
            ]
        ]
    ],

    'zf-versioning' => [
        'uri' => [
            'api.rest.project',
        ]
    ],

    'zf-rest' => [
        'Account\Api\V1\Rest\Project\Controller' => [
            'listener'                   => 'Api\V1\Rest\Project\ProjectResource',
            'route_name'                 => 'api.rest.project',
            'route_identifier_name'      => 'project_id',
            'collection_name'            => 'project',
            'entity_http_methods'        => ['GET', 'PATCH', 'PUT', 'DELETE'],
            'collection_http_methods'    => ['GET', 'POST'],
            'collection_query_whitelist' => ['tech', 'page', 'per_page'],
            'entity_class'               => 'Api\V1\Rest\Project\ProjectEntity',
            'collection_class'           => 'Api\V1\Rest\Project\ProjectCollection',
            'service_name'               => 'Project'
        ]
    ],

    'zf-content-negotiation' => [
        'controllers' => [
            'Api\V1\Rest\Project\Controller' => 'HalJson',

        ],

        'accept_whitelist' => [
            'Api\V1\Rest\Project\Controller' => [
                'application/vnd.api.v1+json',
                'application/hal+json',
                'application/json'
            ]
        ],

        'content_type_whitelist' => [
            'Api\V1\Rest\Project\Controller' => [
                'application/x-www-form-urlencoded',
                'application/vnd.api.v1+json',
                'application/json'
            ]
        ]
    ],

    'zf-hal' => [
        'metadata_map' => [
            'Api\V1\Rest\Project\ProjectEntity' => [
                'entity_identifier_name' => 'project_id',
                'route_name'             => 'api.rest.project',
                'route_identifier_name'  => 'project_id',
                'hydrator'               => 'Zend\Stdlib\Hydrator\ArraySerializable'
            ],

            'Api\V1\Rest\Project\ProjectCollection' => [
                'entity_identifier_name' => 'project_id',
                'route_name'             => 'api.rest.project',
                'route_identifier_name'  => 'project_id',
                'is_collection'          => true
            ]
        ]
    ]
];
