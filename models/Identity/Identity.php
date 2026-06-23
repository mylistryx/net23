<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;
use app\components\interfaces\IdentityPasswordInterface;
use app\components\traits\Identity\IdentityPasswordTrait;
use app\components\traits\Identity\IdentityRepositoryTrait;
use app\components\traits\Identity\IdentityTrait;
use Yii;
use yii\base\Exception;
use yii\web\IdentityInterface;

/**
 * @inheritdoc
 *
 * @property string $id
 *
 * @property string $email
 * @property string $phone
 *
 * @property string $auth_key
 * @property string $password_hash
 *
 * @property string $created_at DateTime
 * @property string $updated_at DateTime
 *
 * @see self::getAuthKey()
 * @property-read string $authKey
 *
 * @see self::setPassword()
 * @property-write string $password
 */
class Identity extends ActiveRecord implements IdentityInterface, IdentityPasswordInterface
{
    use IdentityTrait;
    use IdentityPasswordTrait;
    use IdentityRepositoryTrait;

    public bool $useUuidInsteadInt = true;
    public false|string $createdAtAttribute = 'created_at';
    public false|string $updatedAtAttribute = 'updated_at';

    public static function tableName(): string
    {
        return Tables::Identity->value;
    }

    /**
     * @throws Exception
     */
    public function rules(): array
    {
        return [
            [['auth_key'], 'default', 'value' => Yii::$app->security->generateRandomString()],
            [['auth_key'], 'string', 'length' => 32],
            [['auth_key'], 'unique'],
        ];
    }

}
