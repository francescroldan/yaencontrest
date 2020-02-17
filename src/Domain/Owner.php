<?php

declare(strict_types=1);

namespace App\Domain;

class Owner
{
    private $id;
    private $type;
    private $name;
    private $phonenumber;
    private $email;

    public function __construct(OwnerId $id, OwnerType $type, OwnerName $name, OwnerPhoneNumber $phonenumber, OwnerEmail $email)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->phonenumber = $phonenumber;
        $this->email = $email;
    }

    public static function create(OwnerId $id, OwnerType $type, OwnerName $name, OwnerPhoneNumber $phonenumber, OwnerEmail $email): self
    {
        $owner = new self($id, $type, $name, $phonenumber, $email);

        return $owner;
    }

    public function id(): OwnerId
    {
        return $this->id;
    }

    public function type(): OwnerType
    {
        return $this->type;
    }

    public function name(): OwnerName
    {
        return $this->name;
    }

    public function phonenumber(): OwnerPhonenumber
    {
        return $this->phonenumber;
    }

    public function email(): OwnerEmail
    {
        return $this->email;
    }

    public function __toArray()
    {
        return [
            'id' => $this->id->value(),
            'type' => $this->type->value(),
            'name' => $this->name->value(),
            'phonenumber' => $this->phonenumber->value(),
            'email' => $this->email->value()
        ];
    }
}
