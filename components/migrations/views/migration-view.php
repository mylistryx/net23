<?= '<?php' . PHP_EOL ?>

use app\components\enums\Views;
use app\components\migrations\Migration;

class <?= $className ?> extends Migration
{
    public function safeUp(): void
    {
        $query = $this->query->select([]);
        $this->createView(Views::VIEW_NAME, $query);
    }

    public function safeDown(): void
    {
        $this->dropView(Views::VIEW_NAME);
    }
}
