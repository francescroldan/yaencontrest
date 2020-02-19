<?php

declare(strict_types=1);

namespace App\Application\Create;

use App\Domain\Owner;
use App\Domain\OwnerId;
use App\Domain\OwnerName;
use App\Domain\OwnerType;
use App\Domain\OwnerEmail;
use App\Domain\AdvertisementId;
use App\Domain\OwnerPhoneNumber;
use App\Domain\AdvertisementPrice;
use App\Domain\AdvertisementTitle;
use App\Application\CommandHandler;
use App\Domain\AdvertisementLocality;
use App\Domain\AdvertisementDescription;
use Symfony\Component\VarDumper\VarDumper;
use App\Application\Create\AdvertisementCreator;
use App\Application\Create\CreateAdvertisementCommand;

final class CreateAdvertisementCommandHandler implements CommandHandler
{
    private $creator;

    public function __construct(AdvertisementCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateAdvertisementCommand $command): void
    {
        $id = new AdvertisementId(AdvertisementId::random()->value());
        $title = new AdvertisementTitle($command->title());
        $description = new AdvertisementDescription($command->description());
        $price = new AdvertisementPrice($command->price());
        $locality = new AdvertisementLocality($command->locality());
        $ownerArray = $command->owner();

        $owner = new Owner(
            new OwnerId(OwnerId::random()->value()),
            new OwnerType($ownerArray['type']),
            new OwnerName($ownerArray['name']),
            new OwnerPhoneNumber($ownerArray['phonenumber']),
            new OwnerEmail($ownerArray['email'])
        );

        $this->creator->__invoke($id, $title, $description, $price, $locality, $owner);
    }
}
