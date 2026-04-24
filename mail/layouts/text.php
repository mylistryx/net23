<?php
/**
 * @var View $this
 * @var string $content
 */

use yii\web\View;

$this->beginPage();
$this->beginBody();
echo $content;
$this->endBody();
$this->endPage();
