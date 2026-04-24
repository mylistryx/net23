<?php

namespace app\components\controllers;

use app\components\actions\crud\CreateAction;
use app\components\actions\crud\DeleteAction;
use app\components\actions\crud\IndexAction;
use app\components\actions\crud\ToggleAction;
use app\components\actions\crud\UpdateAction;
use app\components\actions\crud\ViewAction;

abstract class CrudController extends WebController
{
    protected ?string $modelClass;
    protected ?string $searchModelClass;
    protected ?string $isActiveAttribute = 'is_active';
    protected array $disabledActions = [];

    public function actions(): array
    {
        $actions = [
            'index'  => [
                'class'            => IndexAction::class,
                'modelClass'       => $this->modelClass,
                'searchModelClass' => $this->searchModelClass,
            ],
            'create' => [
                'class'      => CreateAction::class,
                'modelClass' => $this->modelClass,
            ],
            'update' => [
                'class'      => UpdateAction::class,
                'modelClass' => $this->modelClass,
            ],
            'delete' => [
                'class'      => DeleteAction::class,
                'modelClass' => $this->modelClass,
            ],
            'view'   => [
                'class'      => ViewAction::class,
                'modelClass' => $this->modelClass,
            ],
            'toggle' => [
                'class'             => ToggleAction::class,
                'modelClass'        => $this->modelClass,
                'isActiveAttribute' => $this->isActiveAttribute,
            ],
        ];

        foreach ($this->disabledActions as $action) {
            unset($actions[$action]);
        }

        return $actions;
    }
}