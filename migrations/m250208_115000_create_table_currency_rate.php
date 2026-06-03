<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m250208_115000_create_table_currency_rate extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::CurrencyRate->value, [
            'currency_code' => $this->stringPk(3),
            'rate'          => $this->currency()->notNull(),
            'date'          => $this->date()->notNull(),
        ]);

        $this->generateFK(Tables::CurrencyRate, 'currency_code', Tables::Currency);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::CurrencyRate->value);
    }
}
