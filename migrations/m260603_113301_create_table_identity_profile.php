<?php

use app\components\enums\Tables;
use app\components\migrations\Migration;

class m260603_113301_create_table_identity_profile extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(Tables::IdentityProfile->value, [
            'identity_id'    => $this->uuidPK(),
            'currency_code'  => $this->string(3)->notNull(),
            'region_code'    => $this->string(2)->notNull(),
            'avatar_file_id' => $this->uuid()->null(),
            'name'           => $this->string()->notNull(),
            'surname'        => $this->string()->notNull(),
            'patronymic'     => $this->string()->null(),
            'birthday'       => $this->date()->notNull(),
            'nickname'       => $this->string()->notNull()->unique(),
            'updated_at'     => $this->dateTime()->notNull(),
        ]);

        $this->generateFK(Tables::IdentityProfile, 'identity_id', Tables::Identity);
        $this->generateFK(Tables::IdentityProfile, 'currency_code', Tables::Currency, 'code', self::SET_NULL);
        $this->generateFK(Tables::IdentityProfile, 'region_code', Tables::Region, 'code', self::SET_NULL);
        $this->generateFK(Tables::IdentityProfile, 'avatar_file_id', Tables::File, 'id', self::SET_NULL);
    }

    public function safeDown(): void
    {
        $this->dropTable(Tables::IdentityProfile->value);
    }
}
