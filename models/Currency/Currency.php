<?php

namespace app\models\Currency;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;

final class Currency extends ActiveRecord
{
    public static function tableName(): string
    {
        return Tables::Currency->value;
    }

    public function rules(): array
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string'],
            [['code', 'name'], 'unique', 'targetAttribute' => ['code', 'name']],
        ];
    }
}