<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class AdvertisementLocality extends StringValueObject
{
    /** @ORM\Column(name="locality", type="string", length=100) */
    protected $locality;

    public function __construct(string $locality)
    {
        parent::__construct($locality);
        $this->locality = $locality;
    }
}
