<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\AdvertisementId;
use App\Domain\AdvertisementTitle;
use App\Domain\AdvertisementDescription;
use App\Domain\AdvertisementPrice;
use App\Domain\AdvertisementLocality;
use App\Domain\Owner;

class Advertisement
{
    private $id;
    private $title;
    private $description;
    private $price;
    private $locality;
    private $owner;
    private $deletedAt;

    public function __construct(
        AdvertisementId $id,
        AdvertisementTitle $title,
        AdvertisementDescription $description,
        AdvertisementPrice $price,
        AdvertisementLocality $locality,
        Owner $owner
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->locality = $locality;
        $this->owner = $owner;
    }

    public static function create(
        AdvertisementId $id,
        AdvertisementTitle $title,
        AdvertisementDescription $description,
        AdvertisementPrice $price,
        AdvertisementLocality $locality,
        Owner $owner
    ): self {
        $advertisement = new self(
            $id,
            $title,
            $description,
            $price,
            $locality,
            $owner
        );

        return $advertisement;
    }


    public function id(): AdvertisementId
    {
        return $this->id;
    }

    public function title(): AdvertisementTitle
    {
        return $this->title;
    }

    public function description(): AdvertisementDescription
    {
        return $this->description;
    }

    public function price(): AdvertisementPrice
    {
        return $this->price;
    }

    public function locality(): AdvertisementLocality
    {
        return $this->locality;
    }

    public function owner(): Owner
    {
        return $this->owner;
    }

    public function delete(): void
    {
        $this->deletedAt = AdvertisementDate::createFromString('now');
    }

    public function recover(): void
    {
        $this->deletedAt = null;
    }

    public function changeTitle(?AdvertisementTitle $title = null)
    {
        if ($title !== null) {
            $this->title = $title;
        }
    }
    public function changeDescription(?AdvertisementDescription $description = null)
    {
        if ($description !== null) {
            $this->description = $description;
        }
    }
    public function changePrice(?AdvertisementPrice $price = null)
    {
        if ($price !== null) {
            $this->price = $price;
        }
    }
    public function changeLocality(?AdvertisementLocality $locality = null)
    {
        if ($locality !== null) {
            $this->locality = $locality;
        }
    }
}
