<?php

namespace App\Entity;

use App\Repository\GesellschaftRepository;
use App\Entity\Vermittlernummer;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: GesellschaftRepository::class)]
class Gesellschaft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Vermittlernummer::class, mappedBy: 'gesellschaft')]
    private $vermittlernummern;

    #[ORM\Column(length: 255)]
    private ?string $name = null;
    
    public function __construct()
    {
        $this->vermittlernummern = new ArrayCollection();
    }

    /**
     * @return Collection|Vermittlernummer[]
     */
    public function getVermittlernummern(): Collection
    {
        return $this->vermittlernummern;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
