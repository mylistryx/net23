<?php

namespace app\helpers;

use app\components\enums\CurrencyCode;
use app\models\Currency\Currency;
use DateMalformedStringException;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Yii;
use yii\base\InvalidArgumentException;

class CurrencyHelper
{
    public static function getCurrencyNumericCode(CurrencyCode $currencyCode): int
    {
        return match ($currencyCode->name) {
            CurrencyCode::RUB->name => 641,
            CurrencyCode::USD->name => 840,
            CurrencyCode::EUR->name => 978,
            CurrencyCode::CNY->name => 156,
            default                 => throw new InvalidArgumentException(Yii::t('currency', 'Unknown currency code: :code', [':currencyCode' => $currencyCode->value]))
        };
    }

    public static function getCurrencyCode(int $numericCode): CurrencyCode
    {
        return match ($numericCode) {
            641     => CurrencyCode::RUB,
            840     => CurrencyCode::USD,
            978     => CurrencyCode::EUR,
            156     => CurrencyCode::CNY,
            default => throw new InvalidArgumentException('Unknown numeric currency code: :numericCode', [':numericCode' => $numericCode])
        };
    }

    public static function findOrCreateCurrencyRate(CurrencyCode $currencyCode, DateTimeInterface $date = new DateTimeImmutable('now', new DateTimeZone('Europe/Moscow'))): Currency
    {
        if (!$currencyRate = Currency::findOne([
            'code' => $currencyCode,
            'date' => $date->format('Y-m-d'),
        ])) {

            $currencyRate = new Currency([
                'code' => $currencyCode,
            ]);
        }

        return $currencyRate;
    }

    /**
     * @throws DateMalformedStringException
     */
    public static function getRateOnDate(CurrencyCode $currencyCode, DateTimeInterface $rateDate = new DateTimeImmutable('now', new DateTimeZone('Europe/Moscow'))): float
    {

        if ($currencyRate = Currency::find()
            ->andWhere(['code' => $currencyCode->name])
            ->andWhere(['date' => $rateDate->format('Y-m-d')])
            ->one()) {

            return $currencyRate->rate;
        }

        throw new InvalidArgumentException(Yii::t('currency', 'Rate for currency :currencyCode on date :rateDate not found!', [
            ':currencyCode' => $currencyCode->value,
            ':rateDate'     => $rateDate->format('d.m.Y'),
        ]));


    }
}