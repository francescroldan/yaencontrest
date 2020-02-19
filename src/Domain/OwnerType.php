<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/** @ORM\Embeddable */
final class OwnerType extends IntValueObject
{
    /** @ORM\Column(name="type", type="integer") */
    protected $type;

    public function __construct(int $type)
    {
        parent::__construct($type);
        $this->type = $type;
    }
}
