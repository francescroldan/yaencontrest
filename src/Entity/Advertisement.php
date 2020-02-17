<?php

// namespace App\Entity;

// use Doctrine\ORM\Mapping as ORM;
// use Doctrine\Common\Collections\ArrayCollection;

// /**
//  * @ORM\Table(name="advertisements")
//  * @ORM\Entity
//  */
// class Advertisement
// {
//     /**
//      * @ORM\Column(type="integer")
//      * @ORM\Id
//      * @ORM\GeneratedValue(strategy="AUTO")
//      */
//     private $id;

//     /**
//      * @ORM\Column(type="string", length=255)
//      */
//     private $title;

//     /**
//      * @ORM\Column(type="string", length=255)
//      */
//     private $description;

//     /**
//      * @ORM\Column(type="decimal", precision=7, scale=2)
//      */
//     private $price;

//     /**
//      * @ORM\Column(type="string", length=100)
//      */
//     private $locality;

//     /**
//      * @ORM\ManyToOne(targetEntity="User", inversedBy="advertisements")
//      * @ORM\JoinColumn(name="advertisement_id", referencedColumnName="id")
//      */
//     private $owner;

//     /**
//      * User constructor.
//      * @param $title
//      * @param $description
//      * @param $price
//      * @param $locality
//      * @param $owner
//      */
//     public function __construct($title, $description, $price, $locality, User $owner)
//     {
//         $this->title = $title;
//         $this->description = $description;
//         $this->price = $price;
//         $this->locality = $locality;
//         $this->owner = $owner;
//     }

//     public function title()
//     {
//         return $this->title;
//     }

//     public function description()
//     {
//         return $this->description;
//     }

//     public function price()
//     {
//         return $this->price;
//     }

//     public function locality()
//     {
//         return $this->locality;
//     }

//     public function owner()
//     {
//         return $this->owner;
//     }
// }
