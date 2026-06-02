<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260516093701_identity_signup_request extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentitySignupRequest->value, [
            'id'                 => $this->primaryKey(),
            'email'              => $this->string()->notNull()->unique(),
            'confirmation_token' => $this->string()->notNull()->unique(),
            'created_at'         => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentitySignupRequest->value);
    }
}
