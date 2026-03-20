<?php

namespace App\Entity;

use App\Repository\EnseigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseigneRepository::class)]
class Enseigne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Fromage>
     */
    #[ORM\ManyToMany(targetEntity: Fromage::class, mappedBy: 'enseigne')]
    private Collection $fromages;

    public function __construct()
    {
        $this->fromages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Fromage>
     */
    public function getFromages(): Collection
    {
        return $this->fromages;
    }

    public function addFromage(Fromage $fromage): static
    {
        if (!$this->fromages->contains($fromage)) {
            $this->fromages->add($fromage);
            $fromage->addEnseigne($this);
        }

        return $this;
    }

    public function removeFromage(Fromage $fromage): static
    {
        if ($this->fromages->removeElement($fromage)) {
            $fromage->removeEnseigne($this);
        }

        return $this;
    }
}
