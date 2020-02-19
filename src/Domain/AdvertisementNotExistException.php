<?php

declare(strict_types=1);

namespace App\Domain;

use DomainException;

final class AdvertisementNotExistException extends DomainException
{
    private $id;

    public function __construct(AdvertisementId $id)
    {
        $this->id = $id;

        parent::__construct(sprintf('The advertisement <%s> does not exist', $this->id->value()));
    }
}
