<?php

namespace App\Entity;

use App\Repository\RdvOffreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: RdvOffreRepository::class)]
class RdvOffre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_heure_rdv_offre = null;

    #[ORM\Column(nullable: true)]
    private ?int $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'rdv_vous')]
    private ?Offre $offre = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureRdvOffre(): ?\DateTimeInterface
    {
        return $this->date_heure_rdv_offre;
    }

    public function setDateHeureRdvOffre(?\DateTimeInterface $date_heure_rdv_offre): self
    {
        $this->date_heure_rdv_offre = $date_heure_rdv_offre;

        return $this;
    }

    public function getIdOffre(): ?int
    {
        return $this->id_offre;
    }

    public function setIdOffre(?int $id_offre): self
    {
        $this->id_offre = $id_offre;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }


}
