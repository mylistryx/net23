<?php

namespace app\components\enums;

use app\components\traits\EnumToArrayTrait;

enum CurrencyCode: string
{
    use EnumToArrayTrait;

    case USD = '$';
    case EUR = '€';
    case RUB = '₽';
    case CNY = '¥';
}