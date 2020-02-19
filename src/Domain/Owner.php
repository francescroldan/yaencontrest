<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="owners")
 * @ORM\Entity
 */
class Owner
{
    /**
     * @ORM\Column(type="string", length=36, unique=true)
     * @ORM\Id
     */
    private $id;

    /** @ORM\Column(name="type", type="integer") */
    private $type;

    /** @ORM\Column(name = "name", type = "string") */
    private $name;

    /** @ORM\Column(name = "phonenumber", type = "string") */
    private $phonenumber;

    /** @ORM\Column(name = "email", type = "string") */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Advertisement", mappedBy="owner")
     */
    private $advertisements;

    public function __construct(OwnerId $id, OwnerType $type, OwnerName $name, OwnerPhoneNumber $phonenumber, OwnerEmail $email)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->phonenumber = $phonenumber;
        $this->email = $email;
        $this->advertisements = new ArrayCollection();
    }

    public static function create(OwnerId $id, OwnerType $type, OwnerName $name, OwnerPhoneNumber $phonenumber, OwnerEmail $email): self
    {
        $owner = new self($id, $type, $name, $phonenumber, $email);

        return $owner;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type->value();
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name->value();
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of phonenumber
     */
    public function getPhonenumber()
    {
        return $this->phonenumber->value();
    }

    /**
     * Set the value of phonenumber
     *
     * @return  self
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email->value();
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of advertisements
     */
    public function getAdvertisements(): Collection
    {
        return $this->advertisements;
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

    // public function phonenumber(): OwnerPhonenumber
    // {
    //     return $this->phonenumber;
    // }

    public function email(): OwnerEmail
    {
        return $this->email;
    }

    public function __toArray()
    {
        return [
            'id' => (string) $this->id,
            'type' => intVal((string) $this->type),
            'name' => (string) $this->name,
            'phonenumber' => (string) $this->phonenumber,
            'email' => (string) $this->email
        ];
    }
}
