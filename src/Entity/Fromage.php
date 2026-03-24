<?php

namespace App\Entity;

use App\Repository\FromageRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: FromageRepository::class)]
class Fromage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $verdict = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'fromages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'fromages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $Categorie = null;

    /**
     * @var Collection<int, Enseigne>
     */
    #[ORM\ManyToMany(targetEntity: Enseigne::class, inversedBy: 'fromages')]
    private Collection $enseigne;

    /**
     * @var Collection<int, Accord>
     */
    #[ORM\ManyToMany(targetEntity: Accord::class, inversedBy: 'fromages')]
    private Collection $accord;

    public function __construct()
    {
        $this->enseigne = new ArrayCollection();
        $this->accord = new ArrayCollection();
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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getVerdict(): ?string
    {
        return $this->verdict;
    }

    public function setVerdict(string $verdict): static
    {
        $this->verdict = $verdict;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection<int, Enseigne>
     */
    public function getEnseigne(): Collection
    {
        return $this->enseigne;
    }

    public function addEnseigne(Enseigne $enseigne): static
    {
        if (!$this->enseigne->contains($enseigne)) {
            $this->enseigne->add($enseigne);
        }

        return $this;
    }

    public function removeEnseigne(Enseigne $enseigne): static
    {
        $this->enseigne->removeElement($enseigne);

        return $this;
    }

    /**
     * @return Collection<int, Accord>
     */
    public function getAccord(): Collection
    {
        return $this->accord;
    }

    public function addAccord(Accord $accord): static
    {
        if (!$this->accord->contains($accord)) {
            $this->accord->add($accord);
        }

        return $this;
    }

    public function removeAccord(Accord $accord): static
    {
        $this->accord->removeElement($accord);

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if($imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
}
