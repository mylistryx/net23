<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
);

return [
    'id'         => 'app-test',
    'basePath'   => dirname(__DIR__),
    'aliases'    => [
        '@tests' => '@app/tests',
    ],
    'language'   => 'en',
    'components' => [
        'assetManager' => [
            'basePath' => dirname(__DIR__) . '/web/assets',
        ],
        'urlManager'   => [
            'showScriptName' => true,
        ],
    ],
    'params'     => $params,
];
