<?php
return [
    'name' => 'Мой магазин',
    'defaultController' => 'user',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => 'localhost',
                'db' => 'gbphp',
                'charset' => 'UTF8',
                'username' => 'root',
                'password' => '',
            ],
        ],
        'render' => [
            'class' => \App\services\renders\TwigRender::class,
        ],
        'userRepository' => [
            'class' => \App\repositories\UserRepository::class,
        ],
        'goodRepository' => [
            'class' => \App\repositories\GoodRepository::class,
        ],
        'userService' => [
            'class' => \App\services\UserService::class,
        ]
    ],
];
