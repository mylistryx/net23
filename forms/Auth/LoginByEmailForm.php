<?php

namespace app\forms\Auth;

use app\components\forms\Form;
use app\models\Identity\Identity;
use Yii;

class LoginByEmailForm extends Form
{
    public ?string $username = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    private false|Identity $identity = false {
        get {
            if ($this->identity === false) {
                $this->identity = Identity::findByUsername($this->username);
            }

            return $this->identity;
        }
    }

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword(string $attribute, ?array $params = null): void
    {
        if (!$this->hasErrors()) {
            $user = $this->identity;

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->identity, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

}
