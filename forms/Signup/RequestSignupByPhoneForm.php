<?php

namespace app\forms\Signup;

use app\components\builders\IdentityBuilder;
use app\components\builders\IdentityCodeBuilder;
use app\components\enums\IdentityCodeType;
use app\components\forms\Form;
use app\helpers\PhoneHelper;
use app\models\Identity\Identity;
use app\models\Identity\IdentityCode;
use yii\db\Exception;

final class RequestSignupByPhoneForm extends Form
{
    public ?string $phone = null;
    public readonly IdentityCode $identityConfirmationCode;

    public function rules(): array
    {
        return [
            [
                ['phone'],
                'required',
            ],
            [
                ['phone'],
                'filter',
                'filter' => [PhoneHelper::class, 'normalize'],
            ],
            [
                ['phone'],
                'unique',
                'targetClass'     => Identity::class,
                'targetAttribute' => 'phone',
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'phone' => 'Phone',
        ];
    }

    /**
     * @throws Exception
     */
    public function sendRequest(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $identity = new IdentityBuilder()
            ->withPhone($this->phone)
            ->build();

        $this->identityConfirmationCode = new IdentityCodeBuilder()
            ->withIdentity($identity)
            ->withType(IdentityCodeType::Verification)
            ->build();

        return $this->identityConfirmationCode->save();
    }
}