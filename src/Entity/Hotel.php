<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addressline1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressline2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $petsAllowed;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $openinghours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="itemreviewed",cascade={"persist"})
     */
    private $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddressline1(): ?string
    {
        return $this->addressline1;
    }

    public function setAddressline1(string $addressline1): self
    {
        $this->addressline1 = $addressline1;

        return $this;
    }

    public function getAddressline2(): ?string
    {
        return $this->addressline2;
    }

    public function setAddressline2(?string $addressline2): self
    {
        $this->addressline2 = $addressline2;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

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

    public function getPetsAllowed(): ?bool
    {
        return $this->petsAllowed;
    }

    public function setPetsAllowed(?bool $petsAllowed): self
    {
        $this->petsAllowed = $petsAllowed;

        return $this;
    }

    public function getOpeninghours(): ?string
    {
        return $this->openinghours;
    }

    public function setOpeninghours(?string $openinghours): self
    {
        $this->openinghours = $openinghours;

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setItemreviewed($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getItemreviewed() === $this) {
                $review->setItemreviewed(null);
            }
        }

        return $this;
    }
}
