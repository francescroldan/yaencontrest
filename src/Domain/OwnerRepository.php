<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Advertisement;

interface OwnerRepository
{
    public function save(Owner $advertisement): void;
}
