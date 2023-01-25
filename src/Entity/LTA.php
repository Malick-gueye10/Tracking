<?php

namespace App\Entity;

use App\Repository\LTARepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LTARepository::class)]
class LTA
{
    public const CREATED_STATE = 0;
    public const DEPART_STATE = 1;
    public const ENROUTE_STATE = 2;
    public const ARRIVEE_STATE = 3;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numLTA = null;

     /**
     * @ORM\Column(type="datetime")
     */
    private $savedDate;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column]
    private ?int $state = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'lta', targetEntity: Colis::class)]
    private Collection $colis;

    public function __construct()
    {
        $this->state = self::CREATED_STATE;
        $this->colis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumLTA(): ?string
    {
        return $this->numLTA;
    }

    public function setNumLTA(string $numLTA): self
    {
        $this->numLTA = $numLTA;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }
    public function getSavedDate(): ?\DateTimeInterface
    {
        return $this->savedDate;
    }

    public function setSavedDate(\DateTimeInterface $savedDate): self
    {
        $this->savedDate = $savedDate;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }
    public function getStateLabel(): string
    {
        switch ($this->state) {
            case self::CREATED_STATE:
                return 'Crée';
                break;

            case self::DEPART_STATE:
                return 'Départ';
                break;

            case self::ENROUTE_STATE:
                return 'En route';
                break;
            case self::ARRIVEE_STATE:
                return 'Colis arrivé';
                break;
        }
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

    /**
     * @return Collection<int, Colis>
     */
    public function getColis(): Collection
    {
        return $this->colis;
    }

    public function addColi(Colis $coli): self
    {
        if (!$this->colis->contains($coli)) {
            $this->colis->add($coli);
            $coli->setLta($this);
        }

        return $this;
    }

    public function removeColi(Colis $coli): self
    {
        if ($this->colis->removeElement($coli)) {
            // set the owning side to null (unless already changed)
            if ($coli->getLta() === $this) {
                $coli->setLta(null);
            }
        }

        return $this;
    }
}
