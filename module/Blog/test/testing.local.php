<?php

use Doctrine\DBAL\Driver\PDOSqlite\Driver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => Driver::class,
                'params' => [
                    //'path' => __DIR__ . '/data/blog-functional-testing.sqlite',
                    'memory' => true,
                ],
            ],
        ],
    ],
];