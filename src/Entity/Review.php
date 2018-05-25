<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $reviewbody;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reviewrating;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $authorname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datepublished;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="reviews")
     */
    private $itemreviewed;

    public function getId()
    {
        return $this->id;
    }

    public function getReviewbody(): ?string
    {
        return $this->reviewbody;
    }

    public function setReviewbody(string $reviewbody): self
    {
        $this->reviewbody = $reviewbody;

        return $this;
    }

    public function getReviewrating(): ?int
    {
        return $this->reviewrating;
    }

    public function setReviewrating(?int $reviewrating): self
    {
        $this->reviewrating = $reviewrating;

        return $this;
    }

    public function getAuthorname(): ?string
    {
        return $this->authorname;
    }

    public function setAuthorname(?string $authorname): self
    {
        $this->authorname = $authorname;

        return $this;
    }

    public function getDatepublished(): ?\DateTimeInterface
    {
        return $this->datepublished;
    }

    public function setDatepublished(\DateTimeInterface $datepublished): self
    {
        $this->datepublished = $datepublished;

        return $this;
    }

    public function getItemreviewed(): ?Hotel
    {
        return $this->itemreviewed;
    }

    public function setItemreviewed(?Hotel $itemreviewed): self
    {
        $this->itemreviewed = $itemreviewed;

        return $this;
    }
}
