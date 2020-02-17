<?php

declare(strict_types=1);

namespace App\Domain;

use \DateTimeImmutable;
use \DateTimeInterface;

abstract class DateValueObject
{
    protected $value;

    public function __construct(\DateTimeImmutable $value)
    {
        $this->value = $value;
    }

    public function value(): \DateTimeImmutable
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value->format(\DateTimeInterface::ATOM);
    }
}
