<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260617_061451_create_table_identity_ban extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityBan, [
            'id'          => $this->uuidPK(),
            'identity_id' => $this->uuid(),
            'is_active'   => $this->boolean(),
            'reason'      => $this->text()->null(),
            'start'       => $this->datetime()->notNull(),
            'end'         => $this->datetime()->notNull(),
            'created_at'  => $this->dateTime(),
            'created_by'  => $this->uuid()->null(),
        ]);

        $this->generateFK(Tables::IdentityBan, 'identity_id', Tables::Identity, 'id');
        $this->generateFK(Tables::IdentityBan, 'created_by', Tables::Identity, 'id');
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentityBan);
    }
}
