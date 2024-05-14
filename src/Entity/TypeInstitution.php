<?php

namespace App\Entity;

use App\Repository\TypeInstitutionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeInstitutionRepository::class)]
class TypeInstitution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Institution>
     */
    #[ORM\OneToMany(mappedBy: 'type_institution', targetEntity: Institution::class)]
    private Collection $institutions;

    public function __construct()
    {
        $this->institutions = new ArrayCollection();
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

    /**
     * @return Collection<int, Institution>
     */
    public function getInstitutions(): Collection
    {
        return $this->institutions;
    }

    public function addInstitution(Institution $institution): static
    {
        if (!$this->institutions->contains($institution)) {
            $this->institutions->add($institution);
            $institution->setTypeInstitution($this);
        }

        return $this;
    }

    public function removeInstitution(Institution $institution): static
    {
        if ($this->institutions->removeElement($institution)) {
            // set the owning side to null (unless already changed)
            if ($institution->getTypeInstitution() === $this) {
                $institution->setTypeInstitution(null);
            }
        }

        return $this;
    }
}
