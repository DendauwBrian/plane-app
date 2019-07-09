<?php

namespace App\Entity;

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
}
