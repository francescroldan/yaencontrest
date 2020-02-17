<?php

namespace App\Tests\Advertisement\Application\Find;

use App\Domain\AdvertisementId;
use PHPUnit\Framework\TestCase;
use App\Domain\AdvertisementRepository;
use App\Application\Find\AdvertisementFinder;
use App\Application\Find\FindAdvertisementCommand;
use App\Application\Find\FindAdvertisementCommandHandler;
use App\Tests\Advertisement\Domain\AdvertisementMockFactory;

class FindAdvertisementCommandHandlerTest extends TestCase
{
    public function testItShouldFindAnAdvertisement()
    {
        $expectedAdvertisement = AdvertisementMockFactory::GenerateRandom();

        $advertisementRepositoryMock = $this->createMock(AdvertisementRepository::class);
        $advertisementRepositoryMock->expects($this->once())
            ->method('search')
            ->willReturn($expectedAdvertisement);

        $advertisementFinder = new AdvertisementFinder($advertisementRepositoryMock);
        $findAdvertisementCommandHandler = new FindAdvertisementCommandHandler($advertisementFinder);

        $findAdvertisementCommand = new FindAdvertisementCommand;
        $findAdvertisementCommand->__invoke($expectedAdvertisement->id()->value(),);

        $foundAdvertisement = $findAdvertisementCommandHandler($findAdvertisementCommand);
        $this->assertTrue($expectedAdvertisement->id()->equals($foundAdvertisement->id()));
    }
}
