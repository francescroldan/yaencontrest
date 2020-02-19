<?php

declare(strict_types=1);

namespace App\Application\Create;

use App\Domain\Owner;
use App\Domain\Advertisement;
use App\Domain\AdvertisementId;
use App\Domain\OwnerRepository;
use App\Domain\AdvertisementPrice;
use App\Domain\AdvertisementTitle;
use App\Domain\AdvertisementLocality;
use App\Domain\AdvertisementRepository;
use App\Domain\AdvertisementDescription;

final class AdvertisementCreator
{
    private $advertisementRepository;
    private $ownerRepository;

    public function __construct(AdvertisementRepository $advertisementRepository, OwnerRepository $ownerRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->ownerRepository = $ownerRepository;
    }

    public function __invoke(
        AdvertisementId $id,
        AdvertisementTitle $title,
        AdvertisementDescription $description,
        AdvertisementPrice $price,
        AdvertisementLocality $locality,
        Owner $owner
    ) {
        $advertisement  = Advertisement::create($id, $title, $description, $price, $locality, $owner);

        $this->ownerRepository->save($owner);
        $this->advertisementRepository->save($advertisement);
    }
}
