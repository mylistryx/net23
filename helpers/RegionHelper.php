<?php

namespace app\helpers;

use app\models\Region\Region;

class RegionHelper
{
    public static function findOrCreate(string $regionCode): Region
    {
        if (!$region = Region::findOne(['code' => $regionCode])) {
            $region = new Region(['code' => $regionCode]);
        }
        return $region;
    }
}