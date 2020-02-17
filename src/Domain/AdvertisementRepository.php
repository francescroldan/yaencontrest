<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Criteria\Criteria;

interface AdvertisementRepository
{
    public function save(Advertisement $advertisement): void;

    public function searchAll(): array;

    public function matching(Criteria $criteria): array;
}
