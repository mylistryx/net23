<?php

namespace app\models\Identity;

use app\components\db\ActiveRecord;
use app\components\enums\Tables;
use app\models\Currency\Currency;
use app\models\File\File;
use app\models\Region\Region;
use DateMalformedStringException;
use DateTimeImmutable;
use yii\db\ActiveQuery;

/**
 * @property string $identity_id
 * @property string $currency_id
 * @property string $currency
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $birthday
 * @property string $nickname
 * @property string $updated_at
 *
 * @see self::getIdentity()
 * @property-read Identity $identity
 *
 * @see self::getFullName()
 * @property-read string $fullName
 *
 * @see self::getAge()
 * @property-read int $age
 */
final class IdentityProfile extends ActiveRecord
{
    public false|string $updatedAtAttribute = 'updated_at';

    public static function tableName(): string
    {
        return Tables::IdentityProfile->value;
    }

    public function rules(): array
    {
        return [
            [['identity_id'], 'required'],
            [['identity_id'], 'exist', 'targetClass' => Identity::class, 'targetAttribute' => ['identity_id' => 'id']],

            [['region_code'], 'required'],
            [['region_code'], 'exist', 'targetClass' => Region::class, 'targetAttribute' => ['region_code' => 'code']],

            [['currency_code'], 'required'],
            [['currency_code'], 'exist', 'targetClass' => Currency::class, 'targetAttribute' => ['currency_code' => 'code']],

            [['name', 'surname', 'birthday'], 'required'],
            [['birthday'], 'date', 'format' => 'Y-m-d'],

            [['name', 'surname', 'nickname'], 'filter', 'filter' => 'trim'],
            [['patronymic'], 'filter', 'filter' => 'trim', 'skipOnEmpty' => true],

            [['name', 'surname', 'nickname'], 'filter', 'filter' => 'mb_strtolower'],
            [['patronymic'], 'filter', 'filter' => 'mb_strtolower', 'skipOnEmpty' => true],

            [['name', 'surname'], 'match', 'pattern' => '/^[а-я]+$/'],
            ['patronymic', 'match', 'pattern' => '/^[а-я]+$/', 'skipOnEmpty' => true],

            [['name', 'surname'], 'filter', 'filter' => 'mb_ucfirst'],
            [['patronymic'], 'filter', 'filter' => 'mb_ucfirst', 'skipOnEmpty' => true],

            [['nickname'], 'default', 'value' => 'user-' . time() . '-' . rand(100, 999)],
            [['nickname'], 'match', 'pattern' => '/^[a-zA-Z0-9а-яА-Я_-+=]+$/'],

            [['avatar_file_id'],
             'exist',
             'targetClass'     => File::class,
             'targetAttribute' => 'id',
             'skipOnEmpty'     => true,
             'filter'          => [
                 'type' => ['image/jpeg', 'image/png'],
             ],
            ],

        ];
    }

    public function getIdentity(): ActiveQuery
    {
        return $this->hasOne(Identity::class, ['identity_id' => 'id']);
    }

    public function getFullName(): string
    {
        return trim(implode(' ', [
            $this->surname,
            $this->name,
            $this->patronymic,
        ]));
    }

    /**
     * @throws DateMalformedStringException
     */
    public function getAge(): int
    {
        $birthday = new DateTimeImmutable($this->birthday);
        $now = new DateTimeImmutable();
        $interval = $birthday->diff($now);
        return $interval->format('y');
    }
}