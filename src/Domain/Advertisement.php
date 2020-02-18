<?php

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="advertisements")
 * @ORM\Entity
 */
class Advertisement
{
    /**
     * @ORM\Column(type="string", length=36, unique=true)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $locality;

    /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="advertisements")
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    public function __construct(
        AdvertisementId $id,
        AdvertisementTitle $title,
        AdvertisementDescription $description,
        AdvertisementPrice $price,
        AdvertisementLocality $locality,
        Owner $owner
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->locality = $locality;
        $this->owner = $owner;
    }

    public static function create(
        AdvertisementId $id,
        AdvertisementTitle $title,
        AdvertisementDescription $description,
        AdvertisementPrice $price,
        AdvertisementLocality $locality,
        Owner $owner
    ): self {
        $advertisement = new self(
            $id,
            $title,
            $description,
            $price,
            $locality,
            $owner
        );

        return $advertisement;
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
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of locality
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set the value of locality
     *
     * @return  self
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }



    public function id(): AdvertisementId
    {
        return $this->id;
    }

    public function title(): AdvertisementTitle
    {
        return $this->title;
    }

    public function description(): AdvertisementDescription
    {
        return $this->description;
    }

    public function price(): AdvertisementPrice
    {
        return $this->price;
    }

    public function locality(): AdvertisementLocality
    {
        return $this->locality;
    }

    public function owner(): Owner
    {
        return $this->owner;
    }

    public function isDeleted(): bool
    {
        return $this->deletedAt !== null ? true : false;
    }

    public function delete(): void
    {
        $this->deletedAt = AdvertisementDate::createFromString('now');
    }

    public function recover(): void
    {
        $this->deletedAt = null;
    }

    public function changeTitle(?AdvertisementTitle $title = null): void
    {
        if ($title !== null) {
            $this->title = $title;
        }
    }
    public function changeDescription(?AdvertisementDescription $description = null): void
    {
        if ($description !== null) {
            $this->description = $description;
        }
    }
    public function changePrice(?AdvertisementPrice $price = null): void
    {
        if ($price !== null) {
            $this->price = $price;
        }
    }
    public function changeLocality(?AdvertisementLocality $locality = null): void
    {
        if ($locality !== null) {
            $this->locality = $locality;
        }
    }
}
