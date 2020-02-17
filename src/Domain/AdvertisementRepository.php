<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Advertisement;

interface AdvertisementRepository
{
    public function save(Advertisement $advertisement): void;
}
