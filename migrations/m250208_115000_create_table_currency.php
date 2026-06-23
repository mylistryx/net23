<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m250208_115000_create_table_currency extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::Currency, [
            'code' => $this->stringPk(3),
            'rate' => $this->currency()->notNull(),
            'date' => $this->date()->notNull()->unique(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::Currency);
    }
}
