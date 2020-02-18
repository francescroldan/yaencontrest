<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class AdvertisementId extends Uuid
{
    protected $value;
}
