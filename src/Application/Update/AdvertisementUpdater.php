<?php

declare(strict_types=1);

namespace App\Application\Update;

use App\Domain\AdvertisementId;
use App\Domain\AdvertisementTitle;
use App\Domain\AdvertisementDescription;
use App\Domain\AdvertisementPrice;
use App\Domain\AdvertisementLocality;
use App\Domain\AdvertisementRepository;
use App\Application\Find\AdvertisementFinder;

final class AdvertisementUpdater
{
    private $advertisementRepository;
    private $finder;

    public function __construct(AdvertisementRepository $advertisementRepository, AdvertisementFinder $finder)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->finder = $finder;
    }

    public function __invoke(
        AdvertisementId $id,
        ?AdvertisementTitle $title = null,
        ?AdvertisementDescription $description = null,
        ?AdvertisementPrice $price = null,
        ?AdvertisementLocality $locality = null
    ): void {
        $advertisement = $this->finder->__invoke($id);

        $advertisement->changeTitle($title);
        $advertisement->changeDescription($description);
        $advertisement->changePrice($price);
        $advertisement->changeLocality($locality);

        $this->advertisementRepository->save($advertisement);
    }
}
