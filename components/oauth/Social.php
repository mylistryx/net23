<?php

namespace app\components\oauth;

use yii\bootstrap5\Html;

class Social
{
    public static function icon(string $name, int $size = 48): string
    {
        $imgName = match ($name) {
            'fb', 'facebook'      => 'fb',
            'google'              => 'google',
            'twitter', 'x'        => 'x',
            'instagram'           => 'instagram',
            'vk', 'vkontakte'     => 'vk',
            'ok', 'odnoklassniki' => 'ok',
            'spotify'             => 'spotify',
            'tg', 'telegram'      => 'tg',
            'whatsapp'            => 'whatsapp',
        };

        $imgSize = match ($size) {
            48      => 48,
            96      => 96,
            144     => 144,
            240     => 240,
            480     => 480,
            default => 48,
        };

        return Html::img('/images/social/' . $imgName . '-' . $imgSize . '.png', ['width' => $imgSize]);
    }
}