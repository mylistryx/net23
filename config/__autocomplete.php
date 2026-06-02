<?php

use app\components\user\WebUser;
use yii\console\Application as ConsoleApplication;
use yii\queue\redis\Queue;
use yii\rbac\DbManager;
use yii\web\Application as WebApplication;

class Yii
{
    public static ConsoleApplication|__Application|WebApplication $app;
}

/**
 * @property DbManager $authManager
 * @property WebUser $user
 * @property Queue $queue
 * @property Redis $redis
 */
class __Application
{
}