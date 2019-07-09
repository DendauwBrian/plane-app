<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaneRepository")
 */
class Plane
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
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Manufacturer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Engines;

    /**
     * @ORM\Column(type="datetime")
     */
    private $buildday;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastflight;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flight", mappedBy="Plane")
     */
    private $flights;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $decommissioned = false;

    public function __construct()
    {
        $this->flights = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->Manufacturer;
    }

    public function setManufacturer(string $Manufacturer): self
    {
        $this->Manufacturer = $Manufacturer;

        return $this;
    }

    public function getEngines(): ?string
    {
        return $this->Engines;
    }

    public function setEngines(?string $Engines): self
    {
        $this->Engines = $Engines;

        return $this;
    }

    public function getBuildDay(): ?\DateTimeInterface
    {
        return $this->buildday;
    }

    public function setBuildDay(\DateTimeInterface $buildday): self
    {
        $this->buildday = $buildday;

        return $this;
    }

    public function getLastflight(): ?\DateTimeInterface
    {
        return $this->lastflight;
    }

    public function setLastflight(?\DateTimeInterface $lastflight): self
    {
        $this->lastflight = $lastflight;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getFlights(): Collection
    {
        return $this->flights;
    }

    public function addFlight(Flight $flight): self
    {
        if (!$this->flights->contains($flight)) {
            $this->flights[] = $flight;
            $flight->setPlane($this);
        }

        return $this;
    }

    public function removeFlight(Flight $flight): self
    {
        if ($this->flights->contains($flight)) {
            $this->flights->removeElement($flight);
            // set the owning side to null (unless already changed)
            if ($flight->getPlane() === $this) {
                $flight->setPlane(null);
            }
        }

        return $this;
    }

    public function getDecommissioned(): ?bool
    {
        return $this->decommissioned;
    }

    public function setDecommissioned(?bool $decommissioned): self
    {
        $this->decommissioned = $decommissioned;

        return $this;
    }
}
