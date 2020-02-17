<?php

declare(strict_types=1);

namespace App\Application\Delete;

use App\Domain\AdvertisementId;
use App\Application\CommandHandler;
use App\Application\Delete\AdvertisementDeleter;
use App\Application\Delete\DeleteAdvertisementCommand;

final class DeleteAdvertisementCommandHandler implements CommandHandler
{
    private $deleter;

    public function __construct(AdvertisementDeleter $deleter)
    {
        $this->deleter = $deleter;
    }

    public function __invoke(DeleteAdvertisementCommand $command): void
    {
        $this->deleter->__invoke(new AdvertisementId($command->id()));
    }
}
