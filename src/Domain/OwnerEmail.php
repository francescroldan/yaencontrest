<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class OwnerEmail extends EmailAddress
{
    /** @ORM\Column(name = "email", type = "string") */
    protected $email;

    public function __construct(string $email)
    {
        parent::__construct($email);
        $this->email = $email;
    }
}
