<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\AgencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgencyRepository::class)]
#[ORM\Table(name: '`agency`')]
class Agency
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message:'Username manquant')]
    #[ORM\Column( length: 255, unique:true)]
    private ?string $username = null;

    #[Assert\Length(min: 6,minMessage: 'Minimum 6 caractères ')]
    #[Assert\NotBlank(message:'Password manquant')]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[Assert\NotBlank(message:'Nom manquant')]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank(message:'Type manquant')]
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[Assert\NotBlank(message:'Matriculation manquante')]
    #[ORM\Column(length: 255)]
    private ?string $matriculation = null;

    #[Assert\NotBlank(message:'Email manquant')]
    #[Assert\Email(message: 'Ce n est pas un Mail Valide' )]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Assert\Length(min: 8, max:8 ,minMessage: 'Minimum 8 chiffres',maxMessage: 'Maximum 8 chiffres',exactMessage: 'Numero Invalide' )]
    #[Assert\NotBlank(message:'Numéro manquant')]
    #[ORM\Column(length: 255)]
    private ?string $phonenumber = null;

    #[Assert\NotBlank(message:'Adresse  manquante')]
    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[Assert\Url(message: 'Url Invalide')]
    #[Assert\NotBlank(message:'Photo manquante')]
    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[Assert\NotBlank(message:'User manquant')]
    #[ORM\OneToOne(cascade: ['persist','remove'])]
    private ?User $user = null;








    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMatriculation(): ?string
    {
        return $this->matriculation;
    }

    public function setMatriculation(string $matriculation): self
    {
        $this->matriculation = $matriculation;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }







}
