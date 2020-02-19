<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class OwnerName extends StringValueObject
{
    /** @ORM\Column(name = "name", type = "string") */
    protected $name;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->name = $name;
    }
}
