<?php

declare(strict_types=1);

namespace App\Application\Find;

use App\Domain\Advertisement;
use App\Domain\AdvertisementId;
use App\Domain\AdvertisementNotExistException;
use App\Domain\AdvertisementRepository;

class AdvertisementFinder
{
    private $advertisementRepository;

    public function __construct(AdvertisementRepository $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
    }

    public function __invoke(AdvertisementId $id): Advertisement
    {
        $advertisement = $this->advertisementRepository->search($id);

        if (null === $advertisement) {
            throw new AdvertisementNotExistException($id);
        }

        return $advertisement;
    }
}
