<?php

namespace app\components\traits;

use DateInvalidTimeZoneException;
use DateMalformedStringException;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use RuntimeException;

/**
 * @see self::getCreatedAt()
 * @see self::setCreatedAt()
 * @property DateTimeInterface $createdAt
 *
 * @see self::getUpdatedAt()
 * @see self::setUpdatedAt()
 * @property DateTimeInterface $updatedAt
 *
 * @see self::getTimeZone()
 * @see self::setTimeZone()
 * @property DateTimeZone $timeZone
 */
trait DateTimeTrait
{
    private string|DateTimeZone $defaultTimeZone = 'Europe/Moscow';
    private string $defaultFormat = 'Y-m-d H:i:s';

    /**
     * @throws DateMalformedStringException
     * @throws DateInvalidTimeZoneException
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        $attribute = $this->createdAtAttribute;
        return new DateTimeImmutable($this->$attribute, new DateTimeZone($this->defaultTimeZone));
    }

    public function setCreatedAt(DateTimeInterface $value): void
    {
        if (false === $this->createdAtAttribute) {
            throw new RuntimeException('setCreatedAtAttribute method requires a $createdAtAttribute attribute be set in model');
        }
        $attribute = $this->createdAtAttribute;
        $this->$attribute = $value->format($this->defaultFormat);
    }

    /**
     * @throws DateMalformedStringException
     * @throws DateInvalidTimeZoneException
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        $attribute = $this->updatedAtAttribute;
        return new DateTimeImmutable($this->$attribute, new DateTimeZone($this->defaultTimeZone));
    }

    public function setUpdatedAt(DateTimeInterface $value): void
    {
        if (false === $this->updatedAtAttribute) {
            throw new RuntimeException('setUpdatedAtAttribute method requires a $updatedAtAttribute attribute to be set in model');
        }
        $attribute = $this->updatedAtAttribute;
        $this->$attribute = $value->format($this->defaultFormat);
    }

    /**
     * @throws DateInvalidTimeZoneException
     */
    public function getDefaultTimeZone(): DateTimeZone
    {
        return is_string($this->defaultTimeZone) ? $this->defaultTimeZone : new DateTimeZone($this->defaultTimeZone);
    }

    public function setDefaultTimeZone(DateTimeZone $value): void
    {
        $this->defaultTimeZone = $value;
    }
}