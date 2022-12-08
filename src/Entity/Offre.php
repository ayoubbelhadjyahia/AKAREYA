<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
#[ORM\Entity(repositoryClass: OffreRepository::class)]
#[Vich\Uploadable]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_bien_offre = null;


    #[Assert\Positive]

    #[ORM\Column(nullable: true)]
    private ?int $prix_offre = null;

    #[Assert\Positive]
    #[ORM\Column(nullable: true)]
    private ?int $superficie_offre = null;

    #[Assert\Choice(['vente', 'achat', 'location'],message:"Vous ne pouvez entrer que vente ou achat ou location")]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $categorie_offre = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detailsrdv = null;
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_offre = null;

    #[ORM\Column]
    private ?int $id_proprietaire = null;

    #[ORM\OneToMany(mappedBy: 'id_offre', targetEntity: RdvOffre::class)]
    private Collection $rdv_vous;

    public function __construct()
    {
        $this->rdv_vous = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeBienOffre(): ?string
    {
        return $this->type_bien_offre;
    }

    public function setTypeBienOffre(?string $type_bien_offre): self
    {
        $this->type_bien_offre = $type_bien_offre;

        return $this;
    }

    public function getPrixOffre(): ?int
    {
        return $this->prix_offre;
    }

    public function setPrixOffre(?int $prix_offre): self
    {
        $this->prix_offre = $prix_offre;

        return $this;
    }

    public function getSuperficieOffre(): ?int
    {
        return $this->superficie_offre;
    }

    public function setSuperficieOffre(?int $superficie_offre): self
    {
        $this->superficie_offre = $superficie_offre;

        return $this;
    }

    public function getCategorieOffre(): ?string
    {
        return $this->categorie_offre;
    }

    public function setCategorieOffre(?string $categorie_offre): self
    {
        $this->categorie_offre = $categorie_offre;

        return $this;
    }

    public function getAdresseOffre(): ?string
    {
        return $this->adresse_offre;
    }

    public function setAdresseOffre(string $adresse_offre): self
    {
        $this->adresse_offre = $adresse_offre;

        return $this;
    }

    public function getIdProprietaire(): ?int
    {
        return $this->id_proprietaire;
    }

    public function setIdProprietaire(int $id_proprietaire): self
    {
        $this->id_proprietaire = $id_proprietaire;

        return $this;
    }

    /**
     * @return Collection<int, RdvOffre>
     */
    public function getRdvVous(): Collection
    {
        return $this->rdv_vous;
    }

    public function addRdvVou(RdvOffre $rdvVou): self
    {
        if (!$this->rdv_vous->contains($rdvVou)) {
            $this->rdv_vous->add($rdvVou);
            $rdvVou->setOffre($this);
        }

        return $this;
    }

    public function removeRdvVou(RdvOffre $rdvVou): self
    {
        if ($this->rdv_vous->removeElement($rdvVou)) {
            // set the owning side to null (unless already changed)
            if ($rdvVou->getOffre() === $this) {
                $rdvVou->setOffre(null);
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

    public function getDetailsrdv(): ?string
    {
        return $this->detailsrdv;
    }

    public function setDetailsrdv(?string $detailsrdv): self
    {
        $this->detailsrdv = $detailsrdv;

        return $this;
    }


}
