<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260603_112844_create_table_identity_code extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityCode->value, [
            'id'          => $this->primaryKey(),
            'identity_id' => $this->uuid(true),
            'code'        => $this->string()->notNull(),
            'code_type'   => $this->integer()->notNull(),
            'updated_at'  => $this->dateTime()->notNull(),
        ]);

        $this->generateFK(Tables::IdentityCode, 'identity_id', Tables::Identity);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentityCode->value);
    }
}
