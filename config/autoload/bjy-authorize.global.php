<?php

use BjyAuthorize\Guard\Controller;
use BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider;
use BjyAuthorize\Provider\Role\Config;

return array(
    'bjyauthorize' => array(
        'identity_provider' => AuthenticationIdentityProvider::class,
        'guards' => array(
            Controller::class => array(
                array('controller' => 'index', 'action' => 'index', 'roles' => array('guest', 'user')),
                array('controller' => 'Application\Controller\Index', 'action' => 'index', 'roles' => array('guest', 'user')),
                array('controller' => 'zfcuser', 'action' => 'login', 'roles' => array('guest')),
                array('controller' => 'zfcuser', 'action' => 'index', 'roles' => array('user')),
            ),
        ),
        'role_providers' => array(
            Config::class => array(
                'guest' => array(),
                'user'  => array(),
                'admin' => array(),
                'super-admin' => array(),
                'ceo'   => array(),
            ),
        ),
    ),
);