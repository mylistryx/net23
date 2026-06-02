<?php

namespace app\components\enums;

use app\components\traits\EnumToArrayTrait;

enum Tables: string
{
    use EnumToArrayTrait;

    case Region = 'region';
    case Identity = 'identity';
    case IdentitySignupRequest = 'identity_signup_request';
    case IdentityPasswordResetRequest = 'identity_password_reset_request';
    case IdentityAccessToken = 'identity_access_token';
    case IdentityStatus = 'identity_status';
    case IdentityProfile = 'identity_profile';

    case File = 'file';

}