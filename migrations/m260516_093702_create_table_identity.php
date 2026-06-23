<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260516_093702_create_table_identity extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::Identity, [
            'id'            => $this->uuidPK(),
            'email'         => $this->string()->null()->unique(),
            'phone'         => $this->string()->null()->unique(),
            'auth_key'      => $this->string(32)->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'created_at'    => $this->dateTime()->notNull(),
            'updated_at'    => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::Identity);
    }
}
