<?php

namespace app\components\behaviors;

use DateMalformedStringException;
use DateTimeImmutable;
use DateTimeZone;
use yii\behaviors\TimestampBehavior;

class DateBehavior extends TimestampBehavior
{
    /**
     * @throws DateMalformedStringException
     */
    protected function getValue($event): string
    {
        return new DateTimeImmutable('now', new DateTimeZone('Europe/Moscow'))->format('Y-m-d');
    }
}