<?php

namespace app\forms\Signup;

use app\components\forms\Form;
use app\models\Identity\Identity;
use Yii;

final class RequestSignupByEmailForm extends Form
{
    public ?string $phone = null;

    public function rules(): array
    {
        return [
            [
                ['phone'],
                'required',
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'phone'    => 'Phone',
        ];
    }

    public function sendRequest(): bool
    {
        if (!$this->validate()) {
            return false;
        }
    }
}