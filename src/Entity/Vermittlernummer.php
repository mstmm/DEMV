<?php

namespace App\Entity;

use App\Repository\VermittlernummerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\UniqueConstraint(
    name: 'vermittlernummer_unique_idx',
    columns: ['gesellschaft_id', 'makler_id', 'vermittlernummer']
  )]

#[ORM\Entity(repositoryClass: VermittlernummerRepository::class)]
class Vermittlernummer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\ManyToOne(targetEntity: Gesellschaft::class, inversedBy: 'gesellschaft')]
    #[ORM\JoinColumn(nullable: false)]
    private $gesellschaft;

    #[ORM\ManyToOne(targetEntity: Makler::class, inversedBy: 'makler')]
    #[ORM\JoinColumn(nullable: false)]
    private $makler;

    #[ORM\Column(type: "string")]
    private $vermittlernummer;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getGesellschaft(): ?Gesellschaft
    {
        return $this->gesellschaft;
    }
    public function setGesellschaft(?Gesellschaft $gesellschaft): self
    {
        $this->gesellschaft = $gesellschaft;
        return $this;
    }
    public function getMakler(): ?Makler
    {
        return $this->makler;
    }
    public function setMakler(?Makler $makler): self
    {
        $this->makler = $makler;
        return $this;
    }
    public function getVermittlernummer(): ?string
    {
        return $this->vermittlernummer;
    }
    public function setVermittlernummert(string $vermittlernummer): self
    {
        $this->vermittlernummer = $vermittlernummer;
        return $this;
    }

}
