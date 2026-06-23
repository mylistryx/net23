<?php

namespace app\components\builders;

use app\components\enums\IdentityCodeType;
use app\components\enums\IdentityTokenType;
use app\models\Identity\Identity;
use app\models\Identity\IdentityCode;
use app\models\Identity\IdentityToken;

class IdentityTokenBuilder
{
    public function __construct(
        private ?Identity          $identity = null,
        private ?IdentityTokenType $type = null,
        private ?string            $token = null)
    {
    }

    public function withIdentity(Identity $identity): static
    {
        $this->identity = $identity;

        return $this;
    }

    public function withType(IdentityTokenType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function withToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function build(): IdentityToken
    {
        return new IdentityToken([
            'identity_id' => $this->identity->id,
            'type'        => $this->type,
            'token'       => $this->token,
        ]);
    }
}