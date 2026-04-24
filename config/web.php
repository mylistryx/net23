<?php

return [
    'id'         => 'app-web',
    'basePath'   => dirname(__DIR__),
    'components' => [
        'user'         => [
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => require __DIR__ . '/routes.php',
        ],
    ],
];