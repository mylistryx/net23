<?php

namespace app\models\Currency;

use app\components\behaviors\DateBehavior;
use app\components\db\ActiveRecord;
use app\components\enums\CurrencyCode;
use app\components\enums\Tables;

/**
 * @property string $code
 * @property float $rate
 * @property string $date
 */
final class Currency extends ActiveRecord
{
    public static function tableName(): string
    {
        return Tables::Currency->value;
    }

    public function myBehaviors(): array
    {
        return [
            'Date' => [
                'class'              => DateBehavior::class,
                'createdAtAttribute' => 'date',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['code', 'rate'], 'required'],
            [['rate'], 'number'],
            [['code'], 'in', 'range' => CurrencyCode::names()],
        ];
    }
}