<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260516_093709_identity_token extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityAccessToken->value, [
            'id' => $this->uuidPK(),
            'identity_id' => $this->uuid(),
            'value' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentityAccessToken->value);
    }
}
