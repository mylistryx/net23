<?php

namespace app\components\enums;

use app\components\traits\EnumToArrayTrait;

enum Tables: string
{
    use EnumToArrayTrait;

    /** Валюты */
    case Currency = 'currency';
    /** Файлы */
    case File = 'file';
    /** Базовый профиль авторизации */
    case Identity = 'identity';
    /** Аватар */
    case IdentityAvatar = 'identity_avatar';
    /** Записи о банах */
    case IdentityBan = 'identity_ban';
    /** СМС коды */
    case IdentityCode = 'identity_code';
    /** Профиль */
    case IdentityProfile = 'identity_profile';
    /** Токены */
    case IdentityToken = 'identity_token';
    /** Регионы РФ */
    case Region = 'region';

}