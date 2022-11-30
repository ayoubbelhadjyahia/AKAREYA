<?php

namespace App\Entity;

use App\Repository\DossierConstRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: DossierConstRepository::class)]
class DossierConst
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\GreaterThan('today',message: 'date supérieur au date de aujourd"hui')]
    #[Assert\LessThan('2023-12-31',message: 'date inferieur au fin d"anne')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $duree_location_dossier_const = null;
    #[Assert\GreaterThan(value:'0',)]
    #[Assert\LessThan(value:'1000',)]
    #[Assert\NotBlank(message: 'champ vide')]
    #[ORM\Column]
    private ?int $id_terrain_const = null;
    #[Assert\GreaterThan(value:'0',)]
    #[Assert\LessThan(value:'1000',)]
    #[Assert\NotBlank(message: 'champ vide')]
    #[ORM\Column]
    private ?int $user_id = null;
    #[ORM\ManyToOne(inversedBy: 'dossierConsts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'champ vide')]
    private ?MatierePremConst $id_matiere_const = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDureeLocationDossierConst(): ?\DateTimeInterface
    {
        return $this->duree_location_dossier_const;
    }

    public function setDureeLocationDossierConst(\DateTimeInterface $duree_location_dossier_const): self
    {
        $this->duree_location_dossier_const = $duree_location_dossier_const;

        return $this;
    }

    public function getIdTerrainConst(): ?int
    {
        return $this->id_terrain_const;
    }

    public function setIdTerrainConst(int $id_terrain_const): self
    {
        $this->id_terrain_const = $id_terrain_const;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getIdMatiereConst(): ?MatierePremConst
    {
        return $this->id_matiere_const;
    }

    public function setIdMatiereConst(?MatierePremConst $id_matiere_const): self
    {
        $this->id_matiere_const = $id_matiere_const;

        return $this;
    }
}
