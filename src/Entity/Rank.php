<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RankRepository")
 */
class Rank
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
    private $Title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pilot", mappedBy="rank")
     */
    private $pilots;

    public function __construct()
    {
        $this->pilots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    /**
     * @return Collection|Pilot[]
     */
    public function getPilots(): Collection
    {
        return $this->pilots;
    }

    public function addPilot(Pilot $pilot): self
    {
        if (!$this->pilots->contains($pilot)) {
            $this->pilots[] = $pilot;
            $pilot->setRank($this);
        }

        return $this;
    }

    public function removePilot(Pilot $pilot): self
    {
        if ($this->pilots->contains($pilot)) {
            $this->pilots->removeElement($pilot);
            // set the owning side to null (unless already changed)
            if ($pilot->getRank() === $this) {
                $pilot->setRank(null);
            }
        }

        return $this;
    }
}
