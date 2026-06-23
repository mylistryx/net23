<?php

namespace app\components\traits\Identity;

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