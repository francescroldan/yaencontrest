<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class OwnerId extends Uuid
{
    /** @ORM\Column(name = "id", type = "integer") */
    protected $value;
}
