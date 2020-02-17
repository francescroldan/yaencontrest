<?php

declare(strict_types=1);

namespace App\Tests\Advertisement\Domain;

use App\Domain\Uuid;
use App\Domain\Advertisement;
use App\Domain\AdvertisementId;
use App\Tests\Advertisement\Domain\MockFactory;
use App\Domain\AdvertisementPrice;
use App\Domain\AdvertisementTitle;
use App\Domain\AdvertisementLocality;
use App\Tests\Advertisement\Domain\OwnerMockFactory;
use App\Domain\AdvertisementDescription;

final class AdvertisementMockFactory
{
    public static function GenerateRandom(): Advertisement
    {
        $data = self::GenerateRandomData();

        $id = new AdvertisementId($data['id']);
        $title = new AdvertisementTitle($data['title']);
        $description = new AdvertisementDescription($data['description']);
        $price = new AdvertisementPrice($data['price']);
        $locality = new AdvertisementLocality($data['locality']);
        $owner = OwnerMockFactory::GenerateRandom();

        return new Advertisement($id, $title, $description, $price, $locality, $owner);
    }

    public static function GenerateRandomData(): array
    {
        $id = (string) Uuid::random();
        $title = MockFactory::random()->sentence();
        $description = MockFactory::random()->paragraph();
        $price = MockFactory::random()->randomFloat(2);
        $locality = MockFactory::random()->state();

        return ['id' => $id, 'title' => $title, 'description' => $description, 'price' => $price, 'locality' => $locality];
    }
}
