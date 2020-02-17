<?php

namespace App\Tests\Advertisement\Application\Delete;

use PHPUnit\Framework\TestCase;
use App\Domain\AdvertisementRepository;
use App\Application\Find\AdvertisementFinder;
use App\Application\Delete\AdvertisementDeleter;
use App\Application\Delete\DeleteAdvertisementCommand;
use App\Tests\Advertisement\Domain\AdvertisementMockFactory;
use App\Application\Delete\DeleteAdvertisementCommandHandler;

class DeleteAdvertisementCommandHandlerTest extends TestCase
{
    public function testItShouldDeleteAnAdvertisement()
    {
        $expectedAdvertisement = AdvertisementMockFactory::GenerateRandom();

        $advertisementRepositoryMock = $this->createMock(AdvertisementRepository::class);
        $advertisementRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->equalTo($expectedAdvertisement));

        $advertisementFinderMock = $this->createMock(AdvertisementFinder::class);
        $advertisementFinderMock->expects($this->once())
            ->method('__invoke')
            ->willReturn($expectedAdvertisement);

        $advertisementDeleter = new AdvertisementDeleter($advertisementRepositoryMock, $advertisementFinderMock);
        $deleteAdvertisementCommandHandler = new DeleteAdvertisementCommandHandler($advertisementDeleter);

        $deleteAdvertisementCommand = new DeleteAdvertisementCommand;
        $deleteAdvertisementCommand->__invoke($expectedAdvertisement->id()->value());

        $deleteAdvertisementCommandHandler($deleteAdvertisementCommand);
    }
}
