<?php

namespace app\components\migrations;

use app\components\enums\Tables;
use BackedEnum;
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

        $table = $this->normalizeTable($table);
        $relatedTable = $this->normalizeTable($relatedTable);

        $fkName = 'FK_' . Inflector::id2camel($table) . '_' . Inflector::id2camel($fieldName) . '__' . Inflector::id2camel($relatedTable) . '_' . Inflector::id2camel($relatedFieldName);

        try {
            $this->addForeignKey($fkName, $table, $field, $relatedTable, $relatedField, $onDelete, $onUpdate);
        } catch (Throwable $e) {
            Console::stderr(PHP_EOL . 'Error:' . $e->getMessage());
        }
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function createTable($table, $columns, $options = null): void
    {
        $table = $this->normalizeTable($table);

        parent::createTable($table, $columns, $options);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropTable($table): void
    {
        $table = $this->normalizeTable($table);

        parent::dropTable($table);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function batchInsert($table, $columns, $rows): void
    {
        $table = $this->normalizeTable($table);

        parent::batchInsert($table, $columns, $rows);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function insert($table, $columns): void
    {
        $table = $this->normalizeTable($table);

        parent::insert($table, $columns);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function upsert($table, $insertColumns, $updateColumns = true, $params = []): void
    {
        $table = $this->normalizeTable($table);

        parent::upsert($table, $insertColumns, $updateColumns, $params);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function update($table, $columns, $condition = '', $params = []): void
    {
        $table = $this->normalizeTable($table);

        parent::update($table, $columns, $condition, $params);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function delete($table, $condition = '', $params = []): void
    {
        $table = $this->normalizeTable($table);

        parent::delete($table, $condition, $params);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     * @param string|Tables $newName
     */
    public function renameTable($table, $newName): void
    {
        $table = $this->normalizeTable($table);

        parent::renameTable($table, $newName);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function truncateTable($table): void
    {
        $table = $this->normalizeTable($table);

        parent::truncateTable($table);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function addColumn($table, $column, $type): void
    {
        $table = $this->normalizeTable($table);

        parent::addColumn($table, $column, $type);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropColumn($table, $column): void
    {
        $table = $this->normalizeTable($table);

        parent::dropColumn($table, $column);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function alterColumn($table, $column, $type): void
    {
        $table = $this->normalizeTable($table);

        parent::alterColumn($table, $column, $type);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function addPrimaryKey($name, $table, $columns): void
    {
        $table = $this->normalizeTable($table);

        parent::addPrimaryKey($name, $table, $columns);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropPrimaryKey($name, $table): void
    {
        $table = $this->normalizeTable($table);

        parent::dropPrimaryKey($name, $table);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function addForeignKey($name, $table, $columns, $refTable, $refColumns, $delete = null, $update = null): void
    {
        $table = $this->normalizeTable($table);

        parent::addForeignKey($name, $table, $columns, $refTable, $refColumns, $delete, $update);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropForeignKey($name, $table): void
    {
        $table = $this->normalizeTable($table);

        parent::dropForeignKey($name, $table);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function createIndex($name, $table, $columns, $unique = false): void
    {
        $table = $this->normalizeTable($table);

        parent::createIndex($name, $table, $columns, $unique);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropIndex($name, $table): void
    {
        $table = $this->normalizeTable($table);

        parent::dropIndex($name, $table);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function addCheck($name, $table, $expression): void
    {
        $table = $this->normalizeTable($table);

        parent::addCheck($name, $table, $expression);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropCheck($name, $table): void
    {
        $table = $this->normalizeTable($table);

        parent::dropCheck($name, $table);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function addCommentOnColumn($table, $column, $comment): void
    {
        $table = $this->normalizeTable($table);

        parent::addCommentOnColumn($table, $column, $comment);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropCommentFromColumn($table, $column): void
    {
        $table = $this->normalizeTable($table);

        parent::dropCommentFromColumn($table, $column);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function addCommentOnTable($table, $comment): void
    {
        $table = $this->normalizeTable($table);

        parent::addCommentOnTable($table, $comment);
    }

    /**
     * @inheritDoc
     * @param string|Tables $table
     */
    public function dropCommentFromTable($table): void
    {
        $table = $this->normalizeTable($table);

        parent::dropCommentFromTable($table);
    }

    private function normalizeTable(string|BackedEnum $table): string
    {
        if ($table instanceof BackedEnum) {
            $table = $table->value;
        }

        return $table;
    }


}