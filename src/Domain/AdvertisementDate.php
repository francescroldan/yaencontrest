<?php

declare(strict_types=1);

namespace App\Domain;

final class AdvertisementDate extends DateValueObject
{
    public static function createFromString(string $dateString): self
    {
        return new self(new \DateTimeImmutable($dateString));
    }
}
