<?php

namespace app\components\traits;

use app\models\Identity\Identity;
use Yii;
use yii\base\Exception;

/**
 * @see Identity
 *
 * @property string $email
 * @property string $password_hash
 *
 * @see self::setPassword()
 * @property-write string $password
 */
trait IdentityPasswordTrait
{
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
}