<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\IdentityCodeType;
use app\components\enums\Tables;
use app\components\traits\DateTimeTrait;
use Yii;
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
    use DateTimeTrait;
    public false|string $createdAtAttribute = 'created_at';
    public false|string $updatedAtAttribute = 'updated_at';

    public static function tableName(): string
    {
        return Tables::IdentityCode->value;
    }

    public function rules(): array
    {
        return [
            [['identity_id', 'code_type'], 'required'],
            [['identity_id', 'code_type'], 'integer'],
            [['code_type'], 'in', 'range', IdentityCodeType::values()],
            [['code'], 'default', 'value' => YII_ENV_DEV ? Yii::$app->params['identity.code.dev'] : rand(Yii::$app->params['identity.code.min'], Yii::$app->params['identity.code.max'])],
            [['code'], 'number', 'min' => Yii::$app->params['identity.code.min'], 'max' => Yii::$app->params['identity.code.max']],
        ];
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