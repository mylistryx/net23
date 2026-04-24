<?php

namespace app\components\forms;

use ReflectionClass;
use Yii;
use yii\base\Model;

abstract class Form extends Model
{
    public static function getTCategory(): string
    {
        return new ReflectionClass(static::class)->getShortName();
    }

    public static function t(string $attribute, array $params = []): string
    {
        return Yii::t(static::getTCategory(), $attribute, $params);
    }
}