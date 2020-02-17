<?php

declare(strict_types=1);

namespace App\Application\Update;

use App\Domain\AdvertisementId;
use App\Domain\AdvertisementPrice;
use App\Domain\AdvertisementTitle;
use App\Application\CommandHandler;
use App\Domain\AdvertisementLocality;
use App\Domain\AdvertisementDescription;
use App\Application\Update\AdvertisementUpdater;
use App\Application\Update\UpdateAdvertisementCommand;

final class UpdateAdvertisementCommandHandler implements CommandHandler
{
    private $updater;

    public function __construct(AdvertisementUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(UpdateAdvertisementCommand $command)
    {
        $id = new AdvertisementId($command->id());
        $title = $command->title() ? new AdvertisementTitle($command->title()) : null;
        $description = $command->description() ? new AdvertisementDescription($command->description()) : null;
        $price = $command->price() ? new AdvertisementPrice($command->price()) : null;
        $locality = $command->locality() ? new AdvertisementLocality($command->locality()) : null;

        $this->updater->__invoke($id, $title, $description, $price, $locality);
    }
}
