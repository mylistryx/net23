<?php

use yii\console\controllers\MigrateController;
use yii\faker\FixtureController;

return [
    'id'                  => 'app-console',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'app\console',
    'controllerMap'       => [
        'fixture' => [
            'class' => FixtureController::class,
        ],
        'migrate' => [
            'class'        => MigrateController::class,
            'templateFile' => '@app/components/migrations/views/migration.php',
        ],
    ],
];