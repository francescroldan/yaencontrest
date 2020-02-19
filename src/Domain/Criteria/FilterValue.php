<?php

declare(strict_types=1);

namespace App\Domain\Criteria;

final class FilterValue
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value();
    }
}
