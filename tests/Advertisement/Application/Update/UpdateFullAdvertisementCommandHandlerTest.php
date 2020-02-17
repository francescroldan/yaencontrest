<?php

namespace App\Tests\Advertisement\Application;

use PHPUnit\Framework\TestCase;
use App\Domain\AdvertisementRepository;
use App\Application\Find\AdvertisementFinder;
use App\Application\Update\AdvertisementUpdater;
use App\Application\Update\UpdateAdvertisementCommand;
use App\Tests\Advertisement\Domain\AdvertisementMockFactory;
use App\Application\Update\UpdateAdvertisementCommandHandler;

class UpdateFullAdvertisementCommandHandlerTest extends TestCase
{
    public function testItShouldUpdateFullAdvertisement()
    {
        $expectedAdvertisement = AdvertisementMockFactory::GenerateRandom();
        $newData = AdvertisementMockFactory::GenerateRandom();

        $updateAdvertisementCommand = new UpdateAdvertisementCommand();
        $updateAdvertisementCommand->__invoke(
            $expectedAdvertisement->id()->value(),
            $newData->title()->value(),
            $newData->description()->value(),
            $newData->price()->value(),
            $newData->locality()->value()
        );

        $advertisementRepositoryMock = $this->createMock(AdvertisementRepository::class);
        $advertisementRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->equalTo($expectedAdvertisement));

        $advertisementFinderMock = $this->createMock(AdvertisementFinder::class);
        $advertisementFinderMock->expects($this->once())
            ->method('__invoke')
            ->willReturn($expectedAdvertisement);


        $advertisementUpdater = new AdvertisementUpdater($advertisementRepositoryMock, $advertisementFinderMock);
        $updateAdvertisementCommandHandler = new UpdateAdvertisementCommandHandler($advertisementUpdater);

        $updateAdvertisementCommandHandler($updateAdvertisementCommand);
    }

    public function testItShouldUpdatePartialAdvertisement()
    {
        $expectedAdvertisement = AdvertisementMockFactory::GenerateRandom();
        $newData = AdvertisementMockFactory::GenerateRandom();

        $updateAdvertisementCommand = new UpdateAdvertisementCommand();
        $updateAdvertisementCommand->__invoke(
            $expectedAdvertisement->id()->value(),
            null,
            $newData->description()->value(),
            null,
            $newData->locality()->value()
        );

        $advertisementRepositoryMock = $this->createMock(AdvertisementRepository::class);
        $advertisementRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->equalTo($expectedAdvertisement));

        $advertisementFinderMock = $this->createMock(AdvertisementFinder::class);
        $advertisementFinderMock->expects($this->once())
            ->method('__invoke')
            ->willReturn($expectedAdvertisement);


        $advertisementUpdater = new AdvertisementUpdater($advertisementRepositoryMock, $advertisementFinderMock);
        $updateAdvertisementCommandHandler = new UpdateAdvertisementCommandHandler($advertisementUpdater);

        $updateAdvertisementCommandHandler($updateAdvertisementCommand);
    }
}
