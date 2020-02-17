<?php

namespace App\Application\Find;

class FindAdvertisementCommand
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
