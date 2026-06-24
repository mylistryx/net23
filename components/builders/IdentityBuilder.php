<?php

namespace app\components\builders;

use app\models\Identity\Identity;

class IdentityBuilder
{
    private ?string $phone = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $authKey = null;

    public function withPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function withEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function withPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function withAuthKey(string $authKey): static
    {
        $this->authKey = $authKey;

        return $this;
    }

    public function build(): Identity
    {
        $identity = new Identity();
        $identity->phone = $this->phone;
        $identity->email = $this->email;
        $identity->password = $this->password;
        $identity->auth_key = $this->authKey;
        return $identity;
    }
}