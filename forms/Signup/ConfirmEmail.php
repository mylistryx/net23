<?php

namespace app\forms\Signup;

use app\components\forms\Form;
use http\Exception\BadMethodCallException;

final class ConfirmEmailForm extends Form
{
    public function __construct(string $token, $config = [])
    {
        if (empty($token)) {
            throw new BadMethodCallException('Confirm email token cannot be blank.');
        }

        parent::__construct($config);
    }
}