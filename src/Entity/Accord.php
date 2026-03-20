<?php

namespace App\Entity;

use App\Repository\AccordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccordRepository::class)]
class Accord
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Fromage>
     */
    #[ORM\ManyToMany(targetEntity: Fromage::class, mappedBy: 'accord')]
    private Collection $fromages;

    public function __construct()
    {
        $this->fromages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
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
            $fromage->addAccord($this);
        }

        return $this;
    }

    public function removeFromage(Fromage $fromage): static
    {
        if ($this->fromages->removeElement($fromage)) {
            $fromage->removeAccord($this);
        }

        return $this;
    }
}
