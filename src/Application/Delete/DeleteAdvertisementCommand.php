<?php

namespace App\Application\Delete;

class DeleteAdvertisementCommand
{
    private $id;

    public function __invoke(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
