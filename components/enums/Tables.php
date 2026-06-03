<?php

namespace app\components\enums;

use app\components\traits\EnumToArrayTrait;

enum Tables: string
{
    use EnumToArrayTrait;

    case Currency = 'currency';
    case CurrencyRate = 'currency_rate';
    case File = 'file';

    case Identity = 'identity';
    case IdentityAvatar = 'identity_avatar';
    case IdentityCode = 'identity_code';
    case IdentityProfile = 'identity_profile';
    case IdentityToken = 'identity_token';
    case Region = 'region';

}