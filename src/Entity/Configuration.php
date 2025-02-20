<?php

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationRepository::class)]
class Configuration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Configuration')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Setting>
     */
    #[ORM\OneToMany(targetEntity: Setting::class, mappedBy: 'configuration', orphanRemoval: true)]
    private Collection $Setting;

    public function __construct()
    {
        $this->Setting = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Setting>
     */
    public function getSetting(): Collection
    {
        return $this->Setting;
    }

    public function addSetting(Setting $setting): static
    {
        if (!$this->Setting->contains($setting)) {
            $this->Setting->add($setting);
            $setting->setConfiguration($this);
        }

        return $this;
    }

    public function removeSetting(Setting $setting): static
    {
        if ($this->Setting->removeElement($setting)) {
            // set the owning side to null (unless already changed)
            if ($setting->getConfiguration() === $this) {
                $setting->setConfiguration(null);
            }
        }

        return $this;
    }
}
