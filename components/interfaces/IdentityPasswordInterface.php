<?php

namespace app\components\interfaces;

interface IdentityPasswordInterface
{
    public function setPassword(string $password): void;

    public function validatePassword(string $password): bool;
}