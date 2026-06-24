<?php

namespace app\components\migrations;

use BackedEnum;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\di\Instance;
use yii\helpers\Console;

class MigrationView extends \yii\db\Migration
{
    protected ?QueryBuilder $queryBuilder = null;
    protected ?Query $query = null;

    /**
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();
        $this->queryBuilder = $this->db->queryBuilder;;
        $this->query = Instance::ensure(Query::class);
    }

    public function createView(string|BackedEnum $viewName, Query|string $query): void
    {
        $viewName = $this->normalizeViewName($viewName);
        $queryString = $this->queryBuilder->createView($viewName, $query);
        try {
            $this->db->createCommand($queryString)->execute();
        } catch (Exception) {
            Console::error("Failed to create view '$viewName'.");
        }
    }

    public function dropView(string|BackedEnum $viewName): void
    {
        $viewName = $this->normalizeViewName($viewName);
        $queryString = $this->queryBuilder->dropView($viewName);
        try {
            $this->db->createCommand($queryString)->execute();
        } catch (Exception) {
            Console::error("Failed to drop view '$viewName'.");
        }

    }

    private function normalizeViewName(string|BackedEnum $viewName): string
    {
        if ($viewName instanceof BackedEnum) {
            $viewName = $viewName->value;
        }

        return $viewName;
    }


}