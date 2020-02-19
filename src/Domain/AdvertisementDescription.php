<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class AdvertisementDescription extends StringValueObject
{
    /** @ORM\Column(name="description", type="string") */
    protected $description;

    public function __construct(string $description)
    {
        parent::__construct($description);
        $this->description = $description;
    }
}
