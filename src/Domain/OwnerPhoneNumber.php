<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
final class OwnerPhoneNumber extends PhoneNumber
{
    /** @ORM\Column(name = "phonenumber", type = "string") */
    protected $phonenumber;

    public function __construct(string $phonenumber)
    {
        parent::__construct($phonenumber);
        $this->phonenumber = $phonenumber;
    }
}
