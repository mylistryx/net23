<?php

use app\components\user\WebUser;
use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;
use yii\redis\Cache;

return [
    'language'   => 'ru',
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap'  => ['log'],
    'components' => [
        'i18n'  => [
            'translations' => [
                '*' => [
                    'class' => PhpMessageSource::class,
                ],
            ],
        ],
        'cache' => [
            'class' => Cache::class,
        ],
        'user'  => [
            'class' => WebUser::class,
        ],
        'log'   => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'vendorPath' => dirname(__DIR__) . '/vendor',
];
