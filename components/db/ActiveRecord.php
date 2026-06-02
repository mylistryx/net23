<?php

namespace app\components\db;

use app\components\behaviors\DateTimeBehavior;
use app\components\behaviors\UuidBehavior;
use Exception;
use Yii;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @inheritDoc
 */
abstract class ActiveRecord extends BaseActiveRecord
{
    public bool $useUuidInsteadInt = false;
    public string|false $createdAtAttribute = false;
    public string|false $updatedAtAttribute = false;
    protected string|false $isActiveAttribute = false;

    public function myBehaviors(): array
    {
        return [];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        if ($this->useUuidInsteadInt) {
            $behaviors['Uuid'] = [
                'class' => UuidBehavior::class,
            ];
        }

        if ($this->createdAtAttribute || $this->updatedAtAttribute) {
            $behaviors['DateTime'] = [
                'class'              => DateTimeBehavior::class,
                'createdAtAttribute' => $this->createdAtAttribute,
                'updatedAtAttribute' => $this->updatedAtAttribute,
            ];
        }

        return ArrayHelper::merge($behaviors, $this->myBehaviors());
    }

    public function myRules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();

        if ($this->isActiveAttribute) {
            $rules[] = [$this->isActiveAttribute, 'required'];
            $rules[] = [$this->isActiveAttribute, 'boolean'];
        }
        return ArrayHelper::merge($rules, $this->myRules());
    }

    public function attributeLabels(): array
    {
        $labels = parent::attributeLabels();

        if ($this->createdAtAttribute) {
            $labels[$this->createdAtAttribute] = Yii::t('app', 'Created at');
        }
        if ($this->updatedAtAttribute) {
            $labels[$this->updatedAtAttribute] = Yii::t('app', 'Updated at');
        }
        if ($this->isActiveAttribute) {
            $labels[$this->isActiveAttribute] = Yii::t('app', 'Is active');
        }

        return ArrayHelper::merge($labels, $this->myRules());
    }

    /**
     * @param string|null $isActiveAttribute
     * @return bool
     * @throws Exception
     */
    public function toggle(?string $isActiveAttribute = null): bool
    {
        if ($isActiveAttribute && $this->hasAttribute($isActiveAttribute)) {
            $currentStatus = $this->getAttribute($isActiveAttribute);
            $this->setAttribute($isActiveAttribute, !$currentStatus);
            return ($this->isAttributeChanged($isActiveAttribute) && $this->save());
        }

        return false;
    }
}