<?php
return [
    'router' => [
        'routes' => [
            'api.rest.project' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/api/project[/:repo_id][/:user][/:project]',
                    'defaults' => ['controller' => 'Account\Api\V1\Rest\Account\Controller']
                ]
            ]
        ]
    ]
];
