<?php

namespace app\models\Identity;

use app\components\behaviors\DateTimeBehavior;
use app\components\db\ActiveRecord;
use app\components\enums\Tables;
use Yii;

/**
 * @property int $id
 * @property string $email
 * @property string $confirmation_token
 * @property string $created_at
 */
final class IdentitySignupRequest extends ActiveRecord
{
    public static function tableName(): string
    {
        return Tables::IdentitySignupRequest->value;
    }

    public function behaviors(): array
    {
        return [
            'DateTime' => [
                'class' => DateTimeBehavior::class,
            ],
        ];
    }

    public function rules(): array
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['confirmation_token', 'default', 'value' => $this->generateConfirmationToken()],
        ];
    }

    public function generateConfirmationToken(): string
    {
        return $this->confirmation_token = Yii::$app->security->generateRandomString();
    }
}