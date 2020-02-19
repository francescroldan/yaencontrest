<?php

declare(strict_types=1);

namespace App\Domain;

abstract class PhoneNumber
{
    private $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        if (!preg_match('/((\+34|0034|34)?[89]\d{8})|((\+34|0034|34)?[67]\d{8})/', str_replace(' ', '', $phoneNumber))) {
            throw new \InvalidArgumentException(sprintf('"%s" is not a valid phone number', $phoneNumber));
        }

        $this->phoneNumber = $phoneNumber;
    }

    public function value()
    {
        return $this->phoneNumber;
    }

    public function __toString()
    {
        return $this->phoneNumber;
    }
}
