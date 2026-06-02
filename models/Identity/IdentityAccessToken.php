<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;
use yii\db\ActiveQuery;

/**
 * @see self::getIdentity()
 * @property null|Identity $identity
 */
final class IdentityAccessToken extends ActiveRecord
{
    public static function tableName(): string
    {
        return Tables::IdentityAccessToken->value;
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['identity_id' => 'id']);
    }
}