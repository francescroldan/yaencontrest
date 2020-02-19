<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class AdvertisementPrice extends FloatValueObject
{
    /**  @ORM\Column(name = "price", type="decimal", precision=7, scale=2) */
    protected $price;

    public function __construct(float $price)
    {
        parent::__construct($price);
        $this->price = $price;
    }
}
