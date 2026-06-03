<?php

namespace app\components\migrations;

use app\components\enums\Tables;
use Throwable;
use yii\db\ColumnSchemaBuilder;
use yii\helpers\Console;
use yii\helpers\Inflector;

class Migration extends \yii\db\Migration
{
    public const string CASCADE = 'CASCADE';
    public const string SET_NULL = 'SET NULL';
    public const string RESTRICT = 'RESTRICT';

    public function uuid(): ColumnSchemaBuilder
    {
        return $this->string(36);
    }

    public function uuidPK(): ColumnSchemaBuilder
    {
        return $this->uuid()->notNull()->unique()->append('PRIMARY KEY');
    }

    public function stringPk(?int $length = null): ColumnSchemaBuilder
    {
        return $this->string($length)->notNull()->append('PRIMARY KEY');
    }

    public function currency(): ColumnSchemaBuilder
    {
        return $this->double(4);
    }

    public function generateFK(
        Tables  $table,
        string  $field,
        Tables  $relatedTable,
        ?string $relatedField = null,
        ?string $onDelete = self::CASCADE,
        ?string $onUpdate = self::CASCADE): void
    {
        if (is_null($relatedField)) {
            $fieldParts = explode('_', $field);
            $relatedField = end($fieldParts);
        }

        $fieldName = str_replace('_', '-', $field);
        $relatedFieldName = str_replace('_', '-', $relatedField);

        $fkName = 'FK_' . $table->name . '_' . Inflector::id2camel($fieldName) . '__' . $relatedTable->name . '_' . Inflector::id2camel($relatedFieldName);

        try {
            $this->addForeignKey($fkName, $table->value, $field, $relatedTable->value, $relatedField, $onDelete, $onUpdate);
        } catch (Throwable $e) {
            Console::stderr(PHP_EOL . 'Error:' . $e->getMessage());
        }
    }
}