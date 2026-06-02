<?php

namespace app\forms\PasswordReset;

use app\components\forms\Form;
use app\models\Identity\Identity;
use InvalidArgumentException;
use Yii;

final class CompletePasswordResetForm extends Form
{
    private ?Identity $identity = null;

    public ?string $password = null;
    public ?string $passwordConfirm = null;

    public function __construct(string $token, array $config = [])
    {
        $this->identity = Identity::findByPasswordResetToken($token);
        if (!$this->identity) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['password', 'passwordConfirm'], 'required'],
            ['password', 'string', 'length' => [Yii::$app->params['identity.minPasswordLength'], Yii::$app->params['identity.minPasswordLength']]],
            ['passwordConfirm', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function resetPassword(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->identity->password = $this->password;
        return $this->identity->save();
    }
}