<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\IdentityTokenType;
use app\components\enums\Tables;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property string $identity_id
 * @property string $email
 * @property string $token
 * @property int $token_type
 * @property string $created_at
 *
 * @property IdentityTokenType $type
 *
 * @see self::getIdentity()
 * @property-read Identity $identity
 */
final class IdentityToken extends ActiveRecord
{
    public false|string $createdAtAttribute = 'created_at';

    public static function tableName(): string
    {
        return Tables::IdentityCode->value;
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['identity_id' => 'id']);
    }

    public function getType(): IdentityTokenType
    {
        return IdentityTokenType::from($this->token_type);
    }

    public function setType(IdentityTokenType $tokenType): IdentityToken
    {
        $this->token_type = $tokenType->value;
    }
}