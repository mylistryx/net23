<?php

namespace app\helpers;

class PhoneHelper
{
    public static function normalize(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) > 9) {
            $phone = substr($phone, -9);
        }

        return $phone;
    }
}