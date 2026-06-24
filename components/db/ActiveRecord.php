<?php

namespace app\components\db;

use app\components\behaviors\DateTimeBehavior;
use app\components\behaviors\UuidBehavior;
use app\components\exceptions\Database\ModelInsertException;
use app\components\exceptions\Database\ModelUpdateException;
use app\components\exceptions\Validation\ModelValidationException;
use Exception;
use InvalidArgumentException;
use Throwable;
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
    protected bool $isActiveAttributeDefaultValue = false;

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
            $rules[] = [$this->isActiveAttribute, 'boolean'];
            $rules[] = [$this->isActiveAttribute, 'default', 'value' => $this->isActiveAttributeDefaultValue];
        }
        return ArrayHelper::merge($rules, $this->myRules());
    }

    public function myAttributeLabels(): array
    {
        return [];
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

        return ArrayHelper::merge($labels, $this->myAttributeLabels());
    }

    /**
     * @return bool
     */
    public function toggle(): bool
    {
        if ($this->isActiveAttribute === false) {
            throw new InvalidArgumentException('$isActiveAttribute is not set');
        }

        $this->isActive() ? $this->setInactive() : $this->setActive();
        return $this->isActive();
    }

    public function setActive(): void
    {
        if ($this->isActiveAttribute === false) {
            throw new InvalidArgumentException('$isActiveAttribute is not set');
        }

        $this->setAttribute($this->isActiveAttribute, true);
    }

    public function setInactive(): void
    {
        if ($this->isActiveAttribute === false) {
            throw new InvalidArgumentException('$isActiveAttribute is not set');
        }

        $this->setAttribute($this->isActiveAttribute, false);
    }

    public function isActive(): bool
    {
        if ($this->isActiveAttribute === false) {
            throw new InvalidArgumentException('$isActiveAttribute is not set');
        }

        return (bool)$this->getAttribute($this->isActiveAttribute);
    }

    /**
     * @throws Throwable
     */
    public function saveOrFail(bool $runValidation = true, ?array $attributes = null): bool
    {
        return $this->isNewRecord ? $this->insert($runValidation, $attributes) : $this->update($runValidation, $attributes);
    }

    public function validateOrFail(null|string|array $attributeNames = null, bool $clearErrors = true): bool
    {
        if (!parent::validate($attributeNames, $clearErrors)) {
            throw new ModelValidationException('Validation failed');
        }

        return true;
    }

    /**
     * @throws Throwable
     */
    public function insertOrFail(bool $runValidation = true, ?array $attributes = null): bool
    {
        if ($runValidation) {
            $this->validateOrFail($attributes);
        }

        if (!parent::insert(false, $attributes)) {
            throw new ModelInsertException('Insert failed');
        }

        return true;
    }

    /**
     * @throws Throwable
     */
    public function updateOrFail(bool $runValidation = true, ?array $attributes = null): bool
    {
        if ($runValidation) {
            $this->validateOrFail($attributes);
        }

        if (!parent::update(false, $attributes)) {
            throw new ModelUpdateException('Update failed');
        }

        return true;
    }
}