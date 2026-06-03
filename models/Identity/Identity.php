<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;
use app\components\interfaces\IdentityPasswordInterface;
use app\components\traits\IdentityPasswordTrait;
use app\components\traits\IdentityTrait;
use yii\web\IdentityInterface;

/**
 * @property string $id
 * @property string $auth_key
 *
 * @property string $created_at
 * @property string $updated_at
 */
class Identity extends ActiveRecord implements IdentityInterface, IdentityPasswordInterface
{
    use IdentityTrait;
    use IdentityPasswordTrait;

    public bool $useUuidInsteadInt = true;
    public false|string $createdAtAttribute = 'created_at';
    public false|string $updatedAtAttribute = 'updated_at';

    public static function tableName(): string
    {
        return Tables::Identity->value;
    }

}
