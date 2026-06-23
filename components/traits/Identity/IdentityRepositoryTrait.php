<?php

namespace app\components\traits\Identity;

use app\components\enums\IdentityStatus;
use app\components\enums\IdentityTokenType;
use app\components\exceptions\Identity\IdentityBannedException;
use app\components\exceptions\Identity\IdentityNotActiveException;
use app\components\exceptions\Identity\IdentityNotFoundException;
use app\models\Identity\Identity;
use app\models\Identity\IdentityToken;

trait IdentityRepositoryTrait
{
    /**
     * @throws IdentityNotFoundException
     */
    public static function findIdentity($id): Identity
    {
        if (!$identity = static::findOne($id)) {
            throw new IdentityNotFoundException();
        }

        self::checkIsActive($identity);
        self::checkIsBanned($identity);

        return $identity;
    }

    public static function findIdentityByAccessToken($token, $type = null): Identity
    {
        return self::findIdentityToken($token, IdentityTokenType::Access)?->identity;
    }

    /**
     * @throws IdentityNotFoundException
     */
    public static function findIdentityByEmail(string $email): static
    {
        if (!$identity = static::findOne(['email' => $email])) {
            throw new IdentityNotFoundException();
        }

        return $identity;
    }

    /**
     * @throws IdentityNotFoundException
     */
    public static function findIdentityByPhone(string $phone): static
    {
        if (!$identity = static::findOne(['phone' => $phone])) {
            throw new IdentityNotFoundException();
        }

        return $identity;
    }

    /**
     * @throws \app\components\exceptions\Identity\IdentityNotActiveException
     */
    private static function checkIsActive(Identity $identity): void
    {
        if ($identity->status !== IdentityStatus::Active) {
            throw new \app\components\exceptions\Identity\IdentityNotActiveException();
        }
    }

    /**
     * @throws \app\components\exceptions\Identity\IdentityBannedException
     */
    private static function checkIsBanned(Identity $identity): void
    {
        if ($identity->status === IdentityStatus::Banned) {
            throw new \app\components\exceptions\Identity\IdentityBannedException();
        }
    }

    private static function findIdentityToken(string $token, IdentityTokenType $type): ?IdentityToken
    {
        return IdentityToken::findOne([
            'token' => $token,
            'type'  => $type->value,
        ]);
    }
}