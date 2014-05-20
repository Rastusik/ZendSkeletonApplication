<?php

use Zend\Authentication\AuthenticationService;
use ZfcRbac\Identity\AuthenticationIdentityProvider;
use ZfcRbac\Role\InMemoryRoleProvider;

return [
    'zfc_rbac' => [
        'guards' => [
            'ZfcRbac\Guard\RouteGuard' => [
                'home' => ['admin'],
            ],
        ],
        'identity_provider' => AuthenticationIdentityProvider::class,
        'role_provider' => [
            InMemoryRoleProvider::class => [
                'admin' => [
                    'children'    => ['member'],
                    'permissions' => ['article.delete'],
                ],
                'registered' => [
                    'children' => ['user'],
                    'permissions' => [],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            AuthenticationService::class => 'zfcuser_auth_service',
        ]
    ]
];
