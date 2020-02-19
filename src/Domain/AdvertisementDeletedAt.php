<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class AdvertisementDeletedAt extends DateValueObject
{

    /** @ORM\Column(name="deleted_at", type="datetime", length=100) */
    protected $deletedAt;

    public function __construct(\DateTimeImmutable $deletedAt)
    {
        parent::__construct($deletedAt);
        $this->deletedAt = $deletedAt;
    }

    public static function createFromString(string $dateString): self
    {
        return new self(new \DateTimeImmutable($dateString));
    }
}
