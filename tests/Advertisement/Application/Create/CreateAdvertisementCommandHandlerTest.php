<?php

namespace App\Tests\Advertisement\Application\Create;

use Faker\Factory;
use App\Domain\Owner;
use App\Domain\Advertisement;
use App\Domain\OwnerRepository;
use PHPUnit\Framework\TestCase;
use App\Domain\AdvertisementRepository;
use App\Application\Create\AdvertisementCreator;
use App\Application\Create\CreateAdvertisementCommand;
use App\Tests\Advertisement\Domain\OwnerMockFactory;
use App\Application\Create\CreateAdvertisementCommandHandler;
use App\Tests\Advertisement\Domain\AdvertisementMockFactory;

class CreateAdvertisementCommandHandlerTest extends TestCase
{
    public function testItShouldCreateAValidAdvertisement()
    {
        $expectedAdvertisement = AdvertisementMockFactory::GenerateRandom();
        $expectedOwner = $expectedAdvertisement->owner();

        $createAdvertisementCommand = new CreateAdvertisementCommand;
        $createAdvertisementCommand->__invoke(
            $expectedAdvertisement->id()->value(),
            $expectedAdvertisement->title()->value(),
            $expectedAdvertisement->description()->value(),
            $expectedAdvertisement->price()->value(),
            $expectedAdvertisement->locality()->value(),
            $expectedAdvertisement->owner()->__toArray()
        );

        $advertisementRepositoryMock = $this->createMock(AdvertisementRepository::class);
        $advertisementRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->equalTo($expectedAdvertisement));

        $ownerRepositoryMock = $this->createMock(OwnerRepository::class);
        $ownerRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->equalTo($expectedOwner));

        $advertisementCreator = new AdvertisementCreator($advertisementRepositoryMock, $ownerRepositoryMock);
        $createAdvertisementCommandHandler = new CreateAdvertisementCommandHandler($advertisementCreator);

        $createAdvertisementCommandHandler($createAdvertisementCommand);
    }
}
