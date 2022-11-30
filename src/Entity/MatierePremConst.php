<?php

namespace App\Entity;

use App\Repository\MatierePremConstRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatierePremConstRepository::class)]
class MatierePremConst
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Assert\NotBlank(message: 'champ vide')]
    #[ORM\Column(length: 255)]
    private ?string $type_matiere_const = null;

    #[ORM\OneToMany(mappedBy: 'id_matiere_const', targetEntity: DossierConst::class)]
    private Collection $dossierConsts;

    public function __construct()
    {
        $this->dossierConsts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeMatiereConst(): ?string
    {
        return $this->type_matiere_const;
    }

    public function setTypeMatiereConst(string $type_matiere_const): self
    {
        $this->type_matiere_const = $type_matiere_const;

        return $this;
    }

    /**
     * @return Collection<int, DossierConst>
     */
    public function getDossierConsts(): Collection
    {
        return $this->dossierConsts;
    }

    public function addDossierConst(DossierConst $dossierConst): self
    {
        if (!$this->dossierConsts->contains($dossierConst)) {
            $this->dossierConsts->add($dossierConst);
            $dossierConst->setIdMatiereConst($this);
        }

        return $this;
    }

    public function removeDossierConst(DossierConst $dossierConst): self
    {
        if ($this->dossierConsts->removeElement($dossierConst)) {
            // set the owning side to null (unless already changed)
            if ($dossierConst->getIdMatiereConst() === $this) {
                $dossierConst->setIdMatiereConst(null);
            }
        }

        return $this;
    }
}
