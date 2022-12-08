<?php

namespace App\Entity;

use App\Repository\MatierePremConstRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: MatierePremConstRepository::class)]
#[Vich\Uploadable]
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

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

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
    /**
     * @param  File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */

    public function setImageFile( $imageFile = null): void
    {
        $this->imageFile = $imageFile;

    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
}
