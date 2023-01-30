<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColisRepository::class)]
class Colis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numColis = null;

    #[ORM\ManyToOne(inversedBy: 'colis')]
    private ?LTA $lta = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumColis(): ?string
    {
        return $this->numColis;
    }

    public function setNumColis(string $numColis): self
    {
        $this->numColis = $numColis;

        return $this;
    }

    public function getLta(): ?LTA
    {
        return $this->lta;
    }

    public function setLta(?LTA $lta): self
    {
        $this->lta = $lta;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

}
