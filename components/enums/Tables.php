<?php

namespace app\components\enums;

use app\components\traits\EnumToArrayTrait;

enum Tables: string
{
    use EnumToArrayTrait;

    case Identity = 'identity';
    case IdentityToken = 'identity_token';
}