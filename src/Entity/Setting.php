<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $propriety = null;

    #[ORM\Column(length: 50)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'Setting')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Configuration $configuration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropriety(): ?string
    {
        return $this->propriety;
    }

    public function setPropriety(string $propriety): static
    {
        $this->propriety = $propriety;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getConfiguration(): ?Configuration
    {
        return $this->configuration;
    }

    public function setConfiguration(?Configuration $configuration): static
    {
        $this->configuration = $configuration;

        return $this;
    }
}
