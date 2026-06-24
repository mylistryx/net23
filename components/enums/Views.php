<?php

namespace app\components\enums;

use app\components\traits\EnumToArrayTrait;

enum Views: string
{
    use EnumToArrayTrait;

    case Demo = 'demo';
}