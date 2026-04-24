<?php

namespace app\console;

use yii\console\Controller;
use yii\console\ExitCode;

class TestController extends Controller
{
    public function actionIndex(?string $message = 'hello world'): int
    {
        $this->stdout($message . PHP_EOL);

        return ExitCode::OK;
    }
}
