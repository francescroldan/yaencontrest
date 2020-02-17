<?php

declare(strict_types=1);

namespace App\Application;

final class AdvertisementsResponse
{
    private $advertisements;

    public function __construct(AdvertisementResponse ...$advertisements)
    {
        $this->advertisements = $advertisements;
    }

    public function advertisements(): array
    {
        return $this->advertisements;
    }
}
