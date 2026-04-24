<?php

namespace app\components\user;

use app\models\Identity;
use yii\web\User;

/**
 * @property Identity $identity
 */
class WebUser extends User
{
    public $identityClass = Identity::class;
}