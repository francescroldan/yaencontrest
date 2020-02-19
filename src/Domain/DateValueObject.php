<?php

declare(strict_types=1);

namespace App\Domain;

use \DateTime;
use \DateTimeInterface;

abstract class DateValueObject
{
    protected $value;

    public function __construct(\DateTime $value)
    {
        $this->value = $value;
    }

    public function value(): \DateTime
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value->format(\DateTimeInterface::ATOM);
    }
}
