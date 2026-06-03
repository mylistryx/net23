<?php

namespace app\components\traits;

use app\components\enums\IdentityTokenType;
use app\models\Identity\Identity;
use app\models\Identity\IdentityToken;

/**
 * @see Identity
 *
 *
 * @see self::getAuthKey()
 * @property-read string $authKey
 *
 * @see self::setPassword()
 * @property-write string $password
 */
trait IdentityTrait
{
    public static function findIdentity($id): ?static
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?static
    {
        return self::findIdentityToken($token, IdentityTokenType::Access)?->identity;
    }

    public static function findIdentityPyEmailVerificationToken($token): ?static
    {
        return self::findIdentityToken($token, IdentityTokenType::Verification)?->identity;
    }

    public static function findIdentityByPasswordResetToken($token): ?static
    {
        return self::findIdentityToken($token, IdentityTokenType::PasswordReset)?->identity;
    }

    protected static function findIdentityToken(string $token, IdentityTokenType $type): ?IdentityToken
    {
        return IdentityToken::findOne([
            'token' => $token,
            'type'  => $type->value,
        ]);
    }

    public function getId(): string
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }
}