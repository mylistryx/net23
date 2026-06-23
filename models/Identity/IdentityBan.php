<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;

class IdentityBan extends ActiveRecord
{
    public bool $useUuidInsteadInt = true;
    public string|false $createdAtAttribute = 'created_at';
    public string|false $isActiveAttribute = 'is_active';
    public bool $isActiveAttributeDefaultValue = true;

    public static function tableName(): string
    {
        return Tables::IdentityBan->value;
    }

    public function myBehaviors(): array
    {
        return [];
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