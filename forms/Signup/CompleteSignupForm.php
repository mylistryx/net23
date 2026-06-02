<?php

namespace app\forms\Signup;

use app\components\enums\IdentityStatus;
use app\components\forms\Form;
use app\models\Identity\Identity;
use BadMethodCallException;
use InvalidArgumentException;

final class CompleteSignupForm extends Form
{
    private ?Identity $identity = null;

    public function __construct(string $token, $config = [])
    {
        if (empty($token)) {
            throw new BadMethodCallException('Confirm email token cannot be blank.');
        }

        $this->identity = Identity::findByEmailConfirmationToken($token);
        if (!$this->identity) {
            throw new InvalidArgumentException('Invalid email confirmation token.');
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [];
    }

    public function confirmEmail(): bool
    {
        $this->identity->setStatus(IdentityStatus::Active);
        return $this->identity->save();
    }
}