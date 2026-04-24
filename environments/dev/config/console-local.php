<?php

use yii\debug\Module as DebugModule;
use yii\gii\Module as GiiModule;

return [
    'bootstrap' => ['debug', 'gii'],
    'modules'   => [
        'debug' => [
            'class' => DebugModule::class,
        ],
        'gii'   => [
            'class' => GiiModule::class,
        ],
    ],
];