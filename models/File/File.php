<?php

namespace app\models\File;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;

abstract class File extends ActiveRecord
{
    public bool $useUuidInsteadInt = true;
    public string|false $createdAtAttribute = 'created_at';

    public static function tableName(): string
    {
        return Tables::File->value;
    }

    public function myRules(): array
    {
        return [];
    }

    public function myAttributeLabels(): array
    {
        return [];
    }
}