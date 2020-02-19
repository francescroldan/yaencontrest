<?php

namespace App\Application\Delete;

use App\Application\Command;

class DeleteAdvertisementCommand implements Command
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
