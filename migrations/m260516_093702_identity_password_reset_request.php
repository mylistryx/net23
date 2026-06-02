<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260516_093702_identity_password_reset_request extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityPasswordResetRequest->value, [
            'id'          => $this->primaryKey(),
            'identity_id' => $this->uuid()->notNull(),
            'email'       => $this->string()->notNull()->unique(),
            'reset_token' => $this->string()->notNull()->unique(),
            'created_at'  => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentitySignupRequest->value);
    }
}
