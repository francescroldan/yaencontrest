<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;
use DateTimeInterface;

abstract class DateValueObject
{
    protected $value;

    public function __construct(DateTimeInmutable $value)
    {
        $this->value = $value;
    }

    public static function createFromString(?string $dateString)
    {
        return self::__construct(new DateTimeImmutable($dateString));
    }

    public function value(): DateTimeInmutable
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value->format(DateTimeInterface::ATOM);
    }
}
