<?php

namespace app\forms\Signup;

use app\components\forms\Form;
use app\models\Identity\Identity;
use Yii;

final class RequestSignupForm extends Form
{
    public ?string $email = null;
    public ?string $username = null;
    public ?string $password = null;

    public function rules(): array
    {
        return [
            [
                ['email', 'username', 'password'],
                'required',
            ],
            [
                'email',
                'email',
            ],
            [
                'username',
                'string',
                'min' => 2,
                'max' => 255,
            ],
            [
                'password',
                'string',
                'min' => 2,
                'max' => 255,
            ],
            [
                'email',
                'unique',
                'targetClass'     => Identity::class,
                'targetAttribute' => 'email',
                'message'         => Yii::t($this->tCategory, 'This email address has already been taken.'),

            ],
            [
                'username',
                'unique',
                'targetClass'     => Identity::class,
                'targetAttribute' => 'username',
                'message'         => Yii::t($this->tCategory, 'This username has already been taken.'),

            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'email'    => 'Email',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function sendRequest(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        return Yii::$app->mailer->compose([
            'html' => 'request-signup-html',
            'text' => 'request-signup-text',
        ])
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            ->send();
    }
}