<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 */
class Flight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $flightts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pilot", inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Pilot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Plane", inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Plane;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="flight")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlightts(): ?\DateTimeInterface
    {
        return $this->flightts;
    }

    public function setFlightts(\DateTimeInterface $flightts): self
    {
        $this->flightts = $flightts;

        return $this;
    }

    public function getPilot(): ?Pilot
    {
        return $this->Pilot;
    }

    public function setPilot(?Pilot $Pilot): self
    {
        $this->Pilot = $Pilot;

        return $this;
    }

    public function getPlane(): ?Plane
    {
        return $this->Plane;
    }

    public function setPlane(?Plane $Plane): self
    {
        $this->Plane = $Plane;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
