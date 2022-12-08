<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\OutilDecoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: OutilDecoRepository::class)]
#[Vich\Uploadable]

class OutilDeco
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $type_outil_d = null;

    #[Assert\GreaterThan('today',message: 'date supérieur au date de aujourd"hui')]
    #[Assert\LessThan('2022-12-31',message: 'date inferieur au fin d"anne')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_mise_Service = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $prix_outil = null;

    #[ORM\OneToMany(mappedBy: 'id_outil_deco', targetEntity: MissionDeco::class,cascade: ['persist','remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $missionDecos;

    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    public function __construct()
    {
        $this->missionDecos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOutilD(): ?string
    {
        return $this->type_outil_d;
    }

    public function setTypeOutilD(string $type_outil_d): self
    {
        $this->type_outil_d = $type_outil_d;

        return $this;
    }

    public function getDateMiseService(): ?\DateTimeInterface
    {
        return $this->Date_mise_Service;
    }

    public function setDateMiseService(\DateTimeInterface $Date_mise_Service): self
    {
        $this->Date_mise_Service = $Date_mise_Service;

        return $this;
    }

    public function getPrixOutil(): ?string
    {
        return $this->prix_outil;
    }

    public function setPrixOutil(string $prix_outil): self
    {
        $this->prix_outil = $prix_outil;

        return $this;
    }

    /**
     * @return Collection<int, MissionDeco>
     */
    public function getMissionDecos(): Collection
    {
        return $this->missionDecos;
    }

    public function addMissionDeco(MissionDeco $missionDeco): self
    {
        if (!$this->missionDecos->contains($missionDeco)) {
            $this->missionDecos->add($missionDeco);
            $missionDeco->setIdOutilDeco($this);
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

    public function removeMissionDeco(MissionDeco $missionDeco): self
    {
        if ($this->missionDecos->removeElement($missionDeco)) {
            // set the owning side to null (unless already changed)
            if ($missionDeco->getIdOutilDeco() === $this) {
                $missionDeco->setIdOutilDeco(null);
            }
        }

        return $this;
    }

}
