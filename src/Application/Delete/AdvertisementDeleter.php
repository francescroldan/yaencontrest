<?php

declare(strict_types=1);

namespace App\Application\Delete;

use App\Domain\AdvertisementId;
use App\Domain\AdvertisementRepository;
use App\Application\Find\AdvertisementFinder;

final class AdvertisementDeleter
{
    private $advertisementRepository;
    private $finder;

    public function __construct(AdvertisementRepository $advertisementRepository, AdvertisementFinder $finder)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->finder = $finder;
    }

    public function __invoke(AdvertisementId $id): void
    {
        $advertisement = $this->finder->__invoke($id);

        $advertisement->delete();

        $this->advertisementRepository->save($advertisement);
    }
}
