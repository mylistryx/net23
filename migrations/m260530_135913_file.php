<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260530_135913_file extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::File->value, [
            'id'         => $this->uuidPK(),
            'identity_id' => $this->uuid()->notNull(),
            'name'       => $this->string()->notNull(),
            'extension'  => $this->string()->notNull(),
            'size'       => $this->integer()->notNull(),
            'type'       => $this->string()->notNull(),
            'hash'       => $this->string()->notNull(),
            'is_public'  => $this->boolean()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::File->value);
    }
}
