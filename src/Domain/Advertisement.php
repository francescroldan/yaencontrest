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

    /** @ORM\Column(name = "title", type = "string", length=255) */
    private $title;

    /** @ORM\Column(name="description", type="string") */
    private $description;

    /**  @ORM\Column(name = "price", type="decimal", precision=7, scale=2) */
    private $price;

    /** @ORM\Column(name="locality", type="string", length=100) */
    private $locality;

    /** @ORM\Column(name="deleted_at", type="datetime", length=100, nullable=true) */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="advertisements")
     */
    private $owner;

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
        if (!$id instanceof AdvertisementId) {
            $id = new AdvertisementId($id);
        }
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title->value();
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        if (!$title instanceof AdvertisementTitle) {
            $title = new AdvertisementTitle($title);
        }
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description->value();
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        if (!$description instanceof AdvertisementDescription) {
            $description = new AdvertisementDescription($description);
        }
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price->value();
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        if (!$price instanceof AdvertisementPrice) {
            $price = new AdvertisementPrice($price);
        }
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of locality
     */
    public function getLocality()
    {
        return $this->locality->value();
    }

    /**
     * Set the value of locality
     *
     * @return  self
     */
    public function setLocality($locality)
    {
        if (!$locality instanceof Advertisementlocality) {
            $locality = new Advertisementlocality($locality);
        }
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

    public function getDeletedAt(): ?\DateTime
    {
        $this->deletedAt = new \DateTime('now');
    }

    public function setDeletedAt(\DateTime $deletedat): self
    {
        if (!$deletedat instanceof Advertisementlocality) {
            $deletedat = new AdvertisementId($deletedat);
        }
        $this->deletedat = $deletedat;

        return $this;
    }

    public function id(): AdvertisementId
    {
        if (!$this->id instanceof AdvertisementId) {
            return new AdvertisementId($this->id);
        }
        return $this->id;
    }

    public function title(): AdvertisementTitle
    {
        if (!$this->title instanceof AdvertisementTitle) {
            return new AdvertisementTitle($this->title);
        }
        return $this->title;
    }

    public function description(): AdvertisementDescription
    {
        if (!$this->description instanceof AdvertisementDescription) {
            return new AdvertisementDescription($this->description);
        }
        return $this->description;
    }

    public function price(): AdvertisementPrice
    {
        if (!$this->price instanceof AdvertisementPrice) {
            return new AdvertisementPrice($this->price);
        }
        return $this->price;
    }

    public function locality(): AdvertisementLocality
    {
        if (!$this->locality instanceof AdvertisementLocality) {
            return new AdvertisementLocality($this->locality);
        }
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
        $this->deletedAt = new \DateTime('now');
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

    public function __toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'locality' => $this->locality,
            'owner' => $this->owner->__toArray(),
        ];
    }
}
