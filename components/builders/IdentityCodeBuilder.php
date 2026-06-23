<?php

namespace app\components\builders;

use app\components\enums\IdentityCodeType;
use app\models\Identity\Identity;
use app\models\Identity\IdentityCode;

class IdentityCodeBuilder
{
    public function __construct(
        private ?Identity         $identity = null,
        private ?IdentityCodeType $type = null,
        private ?string           $code = null)
    {
    }

    public function withIdentity(Identity $identity): static
    {
        $this->identity = $identity;

        return $this;
    }

    public function withType(IdentityCodeType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function withCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function build(): IdentityCode
    {
        return new IdentityCode([
            'identity_id' => $this->identity->id,
            'type'        => $this->type,
            'code'        => $this->code,
        ]);
    }
}