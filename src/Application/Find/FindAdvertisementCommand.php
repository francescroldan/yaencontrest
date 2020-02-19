<?php

namespace App\Application\Find;

use App\Application\Command;

class FindAdvertisementCommand implements Command
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
