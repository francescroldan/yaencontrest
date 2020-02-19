<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class AdvertisementTitle extends StringValueObject
{
    /** @ORM\Column(name = "title", type = "string", length=255) */
    protected $title;

    public function __construct(string $title)
    {
        parent::__construct($title);
        $this->title = $title;
    }
}
