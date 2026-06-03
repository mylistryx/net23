<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m250208_115000_create_table_currency extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::Currency->value, [
            'code'      => $this->string(3)->notNull()->append('PRIMARY KEY'),
            'name'      => $this->string(64)->notNull(),
        ]);

        $this->batchInsert(Tables::Currency->value, ['code', 'name'], [
            ['RUB', 'Российский рубль'],
            ['USD', 'Доллар США'],
            ['EUR', 'Евро'],
            ['CNY', 'Йена'],
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::Currency->value);
    }
}
