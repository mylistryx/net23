<?php

namespace app\models\Region;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;

/**
 * @property string $code
 * @property string $name
 */
final class Region extends ActiveRecord
{
    public function getPrimaryKey($asArray = false): string
    {
        return 'code';
    }

    public static function tableName(): string
    {
        return Tables::Region->value;
    }
}