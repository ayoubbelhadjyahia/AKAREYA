<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[ORM\Entity(repositoryClass: UserRepository::class)]
//#[Vich\Uploadable]
#[ORM\Table(name: '`user`')]
//#[UniqueEntity('username', message: 'Username deja Existant')]
class User
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message:'Username manquant')]
    #[ORM\Column( length: 255, unique:true)]
    //#[Assert\Unique(message: 'Username deja Existant')]
    private ?string $username = null;

    #[Assert\Length(min: 6,minMessage: 'Minimum 6 caractères ')]
    #[Assert\NotBlank(message:'Password manquant')]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[Assert\NotBlank(message:'Nom manquant')]
    #[ORM\Column( length: 255)]
    private ?string $name = null;

    #[Assert\NotBlank(message:'Role manquant')]
    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[Assert\Length(min: 8, max:8 ,minMessage: 'Minimum 8 chiffres',maxMessage: 'Maximum 8 chiffres',exactMessage: 'Numero Invalide' )]
    #[Assert\NotBlank(message:'Numéro manquant')]
    #[ORM\Column(length: 255)]
    private ?string $phonenumber = null;

    #[Assert\Length(min: 8, max:8 ,minMessage: 'Minimum 8 chiffres',maxMessage: 'Maximum 8 chiffres' , exactMessage:'CIN Invalide' )]
    #[Assert\NotBlank(message:'CIN manquant')]
    #[ORM\Column(length: 255)]
    private ?string $cin = null;

    #[Assert\NotBlank(message:'Email manquant')]
    #[Assert\Email(message: 'Ce n est pas un Mail Valide' )]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /*#[Vich\UploadableField(mapping: 'products', fileNameProperty: 'photo')]
    private ?File $image = null;*/

   // #[Assert\Url(message: 'Url de l image non Valide ')]
    #[ORM\Column(length: 255)]
    //#[Assert\NotBlank(message:'Photo manquante')]
    private ?string $photo = null;




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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

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




    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }


}
