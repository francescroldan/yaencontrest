<?php

declare(strict_types=1);

namespace App\Application;

final class AdvertisementResponse
{
    private $id;
    private $name;
    private $duration;

    public function __construct(string $id, string $title, string $description, float $price, string $locality, array $owner)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->locality = $locality;
        $this->owner = $owner;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function locality(): string
    {
        return $this->locality;
    }

    public function owner(): array
    {
        return $this->owner;
    }
}
