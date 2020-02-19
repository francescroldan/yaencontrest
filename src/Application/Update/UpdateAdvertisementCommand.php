<?php

namespace App\Application\Update;

use App\Application\Command;

class UpdateAdvertisementCommand implements Command
{
    private $id;
    private $title;
    private $description;
    private $price;
    private $locality;
    private $owner;

    public function __invoke(string $id, ?string $title = null, ?string $description = null, ?float $price = null, ?string $locality = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->locality = $locality;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function price(): ?float
    {
        return $this->price;
    }

    public function locality(): ?string
    {
        return $this->locality;
    }
}
