<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\IdentityStatus;
use app\components\enums\IdentityTokenType;
use Yii;
use yii\base\Exception;
use yii\web\IdentityInterface;

/**
 * @property int|string $id
 * @property string $email
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 *
 * @see self::getAuthKey()
 * @property-read string $authKey
 *
 * @see self::setPassword()
 * @property-write string $password
 */
class Identity extends ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id): ?static
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        $token = IdentityAccessToken::findOne([
            'token'          => $token,
            'type'           => IdentityTokenType::Access->value,
        ]);

        return $token?->identity;
    }

    public static function findByEmailConfirmationToken(string $token): ?static
    {
        $token = IdentityAccessToken::findOne([
            'token' => $token,
            'type'  => IdentityTokenType::Verification->value,
        ]);

        return $token?->identity;
    }

    public function getId(): int|string
    {
        return $this->primaryKey;
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @throws Exception
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @throws Exception
     */
    public function generateAuthKey(): string
    {
        return $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
