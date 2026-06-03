<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\IdentityCodeType;
use app\components\enums\Tables;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property string $identity_id
 * @property string $code
 * @property int $code_type
 * @property string $updated_at
 *
 * @see self::getIdentity()
 * @property-read Identity $identity
 *
 * @see self::getType()
 * @see self::setType()
 * @property IdentityCodeType $type
 */
final class IdentityCode extends ActiveRecord
{
    public false|string $updatedAtAttribute = 'updated_at';

    public static function tableName(): string
    {
        return Tables::IdentityCode->value;
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['identity_id' => 'id']);
    }

    public function getType(): IdentityCodeType
    {
        return IdentityCodeType::from($this->code_type);
    }

    public function setType(IdentityCodeType $codeType): void
    {
        $this->code_type = $codeType->value;
    }
}