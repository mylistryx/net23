<?php

namespace app\jobs;

use yii\base\Component;
use yii\queue\JobInterface;

class DemoJob extends Component implements JobInterface
{
    public string $url;
    public string $file;

    public function execute($queue): void
    {
        file_put_contents($this->file, file_get_contents($this->url));
    }
}