<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;


use App\Repository\MissionDecoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionDecoRepository::class)]
#[ApiResource]
class MissionDeco
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank,message('aaaaaaaaa')]
    #[ORM\Column(length: 255)]
    private ?string $intituler_mission_deco = null;

    #[Assert\GreaterThan('today',message: 'date supérieur au date de aujourd"hui')]

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut_mission = null;


    #[Assert\GreaterThan('today',message: 'date supérieur au date de aujourd"hui')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin_mission = null;
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $localisation_mission = null;

    #[ORM\ManyToOne(inversedBy: 'missionDecos',cascade: ['persist','remove'])]


    private ?OutilDeco $id_outil_deco = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitulerMissionDeco(): ?string
    {
        return $this->intituler_mission_deco;
    }

    public function setIntitulerMissionDeco(string $intituler_mission_deco): self
    {
        $this->intituler_mission_deco = $intituler_mission_deco;

        return $this;
    }

    public function getDateDebutMission(): ?\DateTimeInterface
    {
        return $this->date_debut_mission;
    }

    public function setDateDebutMission(\DateTimeInterface $date_debut_mission): self
    {
        $this->date_debut_mission = $date_debut_mission;

        return $this;
    }

    public function getDateFinMission(): ?\DateTimeInterface
    {
        return $this->date_fin_mission;
    }

    public function setDateFinMission(\DateTimeInterface $date_fin_mission): self
    {
        $this->date_fin_mission = $date_fin_mission;

        return $this;
    }

    public function getLocalisationMission(): ?string
    {
        return $this->localisation_mission;
    }

    public function setLocalisationMission(string $localisation_mission): self
    {
        $this->localisation_mission = $localisation_mission;

        return $this;
    }

    public function getIdOutilDeco(): ?OutilDeco
    {
        return $this->id_outil_deco;
    }

    public function setIdOutilDeco(?OutilDeco $id_outil_deco): self
    {
        $this->id_outil_deco = $id_outil_deco;

        return $this;
    }
}
