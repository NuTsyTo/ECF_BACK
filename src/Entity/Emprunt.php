<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateEmprunt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateRetour = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Emprunteur $emprunteurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->DateEmprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $DateEmprunt): static
    {
        $this->DateEmprunt = $DateEmprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->DateRetour;
    }

    public function setDateRetour(?\DateTimeInterface $DateRetour): static
    {
        $this->DateRetour = $DateRetour;

        return $this;
    }

    public function getEmprunteurs(): ?Emprunteur
    {
        return $this->emprunteurs;
    }

    public function setEmprunteurs(?Emprunteur $emprunteurs): static
    {
        $this->emprunteurs = $emprunteurs;

        return $this;
    }
}
