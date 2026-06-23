<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\IdentityTokenType;
use app\components\enums\Tables;
use Yii;
use yii\base\Exception;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property string $identity_id
 * @property string $token
 * @property int $token_type
 * @property string $created_at
 * @property string $updated_at
 *
 * @property IdentityTokenType $type
 *
 * @see self::getIdentity()
 * @property-read Identity $identity
 */
final class IdentityToken extends ActiveRecord
{
    public false|string $createdAtAttribute = 'created_at';
    public false|string $updatedAtAttribute = 'updated_at';

    public static function tableName(): string
    {
        return Tables::IdentityCode->value;
    }

    /**
     * @throws Exception
     */
    public function rules(): array
    {
        return [
            [['identity_id', 'token_type'], 'required'],
            [['identity_id', 'token_type'], 'integer'],
            [['token_type'], 'in', 'range', IdentityTokenType::values()],
            [['identity_id'], 'exist', 'targetClass' => Identity::class, 'targetAttribute' => 'id'],
            [['token'], 'default', 'value' => Yii::$app->security->generateRandomString()],
            [['token'], 'string'],
            [['token'], 'unique'],
        ];
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['identity_id' => 'id']);
    }

    public function getType(): IdentityTokenType
    {
        return IdentityTokenType::from($this->token_type);
    }

    public function setType(IdentityTokenType $tokenType): void
    {
        $this->token_type = $tokenType->value;
    }
}