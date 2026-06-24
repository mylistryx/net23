<?php

use app\components\enums\Tables;
use app\components\enums\Views;
use app\components\migrations\MigrationView;

class m260624_125048_test extends MigrationView
{
    public function safeUp(): void
    {
        $query = $this->query->select(['id', 'email'])->from(Tables::Identity->value);

        $this->createView(Views::Demo, $query);
    }

    public function safeDown(): void
    {
        $this->dropView(Views::Demo);
    }
}
