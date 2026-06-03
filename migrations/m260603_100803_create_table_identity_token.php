<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260603_100803_create_table_identity_token extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityToken->value, [
            'id'          => $this->primaryKey(),
            'identity_id' => $this->uuid(true),
            'token'       => $this->string()->notNull(),
            'token_type'  => $this->integer()->notNull(),
            'created_at'  => $this->dateTime()->notNull(),
        ]);

        $this->generateFK(Tables::IdentityToken, 'identity_id', Tables::Identity);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentityToken->value);
    }
}
