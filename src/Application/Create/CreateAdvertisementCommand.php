<?php

namespace App\Application\Create;

class CreateAdvertisementCommand
{
    private $id;
    private $title;
    private $description;
    private $price;
    private $locality;
    private $owner;

    public function __invoke(string $title, string $description, float $price, string $locality, array $owner)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->locality = $locality;
        $this->owner = $owner;
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
