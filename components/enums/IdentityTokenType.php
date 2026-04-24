<?php

namespace app\components\enums;

use app\components\traits\EnumToArrayTrait;

enum IdentityTokenType: int
{
    use EnumToArrayTrait;

    case Access = 1000;
    case PasswordReset = 100;
    case Verification = 200;
}