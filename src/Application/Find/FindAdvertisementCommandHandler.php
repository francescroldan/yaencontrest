<?php

declare(strict_types=1);

namespace App\Application\Find;

use App\Domain\Advertisement;
use App\Domain\AdvertisementId;
use App\Application\CommandHandler;
use App\Application\Find\AdvertisementFinder;
use App\Application\Find\FindAdvertisementCommand;

final class FindAdvertisementCommandHandler implements CommandHandler
{
    private $finder;

    public function __construct(AdvertisementFinder $finder)
    {
        $this->finder = $finder;
    }

    public function __invoke(FindAdvertisementCommand $command): Advertisement
    {
        return $this->finder->__invoke(new AdvertisementId($command->id()));
    }
}
