<?php

use yii\console\controllers\MigrateController;
use yii\faker\FixtureController;

return [
    'id'                  => 'app-console',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'app\console',
    'controllerMap'       => [
        'fixture'      => [
            'class' => FixtureController::class,
        ],
        'migrate'      => [
            'class'        => MigrateController::class,
            'templateFile' => '@app/components/migrations/views/migration.php',
        ],
        'migrate-view' => [
            'class'                  => MigrateController::class,
            'migrationPath'          => ['@app/migrations/views'],
            'migrationTable'         => '{{%migration_view}}',
            'templateFile'           => '@app/components/migrations/views/migration-view.php',
            'generatorTemplateFiles' => [],
        ],
    ],
];