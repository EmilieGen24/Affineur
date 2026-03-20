<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pate = null;

    /**
     * @var Collection<int, Fromage>
     */
    #[ORM\OneToMany(targetEntity: Fromage::class, mappedBy: 'Categorie')]
    private Collection $fromages;

    public function __construct()
    {
        $this->fromages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPate(): ?string
    {
        return $this->pate;
    }

    public function setPate(string $pate): static
    {
        $this->pate = $pate;

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
            $fromage->setCategorie($this);
        }

        return $this;
    }

    public function removeFromage(Fromage $fromage): static
    {
        if ($this->fromages->removeElement($fromage)) {
            // set the owning side to null (unless already changed)
            if ($fromage->getCategorie() === $this) {
                $fromage->setCategorie(null);
            }
        }

        return $this;
    }
}
