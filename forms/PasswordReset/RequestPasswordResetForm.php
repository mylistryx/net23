<?php

namespace app\forms\PasswordReset;

use app\components\forms\Form;
use app\models\Identity\Identity;
use Yii;

final class RequestPasswordResetForm extends Form
{
    public ?string $email = null;

    public function rules(): array
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist', 'targetClass' => Identity::class, 'targetAttribute' => ['email' => 'email']],
        ];
    }

    public function sendRequest(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        return $email = Yii::$app->mailer
            ->compose(
                ['html' => 'passwordResetRequest-html', 'text' => 'passwordResetRequest-text'],
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}