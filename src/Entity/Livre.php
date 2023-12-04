<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $Titre = null;

    #[ORM\Column(nullable: true)]
    private ?int $AnnéeEdition = null;

    #[ORM\Column]
    private ?int $NombrePage = null;

    #[ORM\Column(length: 190, nullable: true)]
    private ?string $CodeIsbn = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Auteur $auteur = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'livres')]
    private Collection $genres;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getAnnéeEdition(): ?int
    {
        return $this->AnnéeEdition;
    }

    public function setAnnéeEdition(?int $AnnéeEdition): static
    {
        $this->AnnéeEdition = $AnnéeEdition;

        return $this;
    }

    public function getNombrePage(): ?int
    {
        return $this->NombrePage;
    }

    public function setNombrePage(int $NombrePage): static
    {
        $this->NombrePage = $NombrePage;

        return $this;
    }

    public function getCodeIsbn(): ?string
    {
        return $this->CodeIsbn;
    }

    public function setCodeIsbn(?string $CodeIsbn): static
    {
        $this->CodeIsbn = $CodeIsbn;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): static
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): static
    {
        $this->genres->removeElement($genre);

        return $this;
    }
}
