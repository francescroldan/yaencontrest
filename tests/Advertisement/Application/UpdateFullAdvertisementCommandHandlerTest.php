<?php

namespace App\Tests\Advertisement\Application;

use Faker\Factory;
use App\Domain\Advertisement;
use App\Domain\AdvertisementRepository;
use PHPUnit\Framework\TestCase;
use App\Application\AdvertisementUpdater;
use App\Application\UpdateAdvertisementCommand;
use App\Application\UpdateAdvertisementCommandHandler;
use App\Tests\Advertisement\Domain\AdvertisementMockFactory;

class UpdateFullAdvertisementCommandHandlerTest extends TestCase
{
    public function itShouldUpdateAdvertisement()
    {
        $adverisementData = AdvertisementMockFactory::GenerateRandomData();
        $updateAdvertisementCommand = new UpdateAdvertisementCommand(
            $adverisementData['id'],
            $adverisementData['title'],
            $adverisementData['description'],
            $adverisementData['price'],
            $adverisementData['locality'],
            $adverisementData['owner']
        );
        $advertisementRepositoryMock = $this->createMock(AdvertisementRepository::class)
            ->shouldReceive('save')
            ->with(Advertisement::class)
            ->once()
            ->andReturnNull();

        $advertisementUpdater = new AdvertisementUpdater($advertisementRepositoryMock);
        $updateAdvertisementCommandHandler = new UpdateAdvertisementCommandHandler($advertisementUpdater);

        $updateAdvertisementCommandHandler($updateAdvertisementCommand);
    }
}
