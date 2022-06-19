<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EmployeRepository::class)]
#[UniqueEntity(
    fields: "email",
    message: "Email déjà utilisé."
)]
#[UniqueEntity(
    fields: "telephone",
    message: "Numéro de téléphone déjà utilisé."
)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: "Le prénom doit contenir au minimum {{ limit }} lettres.",
        maxMessage: "Le prénom doit contenir au maximum {{ limit }} lettres."
    )]
    private $prenom;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: "Le nom doit contenir au minimum {{ limit }} lettres.",
        maxMessage: "Le nom doit contenir au maximum {{ limit }} lettres."
    )]
    private $nom;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\Regex(pattern: "/^[0-9]+$/")]
    #[Assert\Length(
        min: 10,
        max: 10,
        exactMessage: "Le numéro doit contenir {{ limit }} chiffres."
    )]
    private $telephone;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\Email(message: "L'email n'est pas valide")]
    private $email;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\Length(
        min: 10,
        max: 200,
        minMessage: "L'adresse doit contenir au minimum {{ limit }} caractères.",
        maxMessage: "L'adresse doit contenir au maximum {{ limit }} caractères."
    )]
    private $adresse;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\Length(
        min: 2,
        max: 200,
        minMessage: "Le poste doit contenir au minimum {{ limit }} caractères.",
        maxMessage: "Le poste doit contenir au maximum {{ limit }} caractères."
    )]
    private $poste;

    #[ORM\Column(type: 'string', length: 200)]
    #[Assert\Regex(pattern: "/^[0-9]+$/")]
    #[Assert\Length(
        min: 1,
        max: 10,
        minMessage: "Le salaire doit avoir au minimum {{ limit }} chiffre.",
        maxMessage: "Le salaire doit avoir au maximum {{ limit }} chiffres."
    )]
    #[Assert\PositiveOrZero]
    #[Assert\LessThanOrEqual(
        value: 1_000_000,
        message: "Salaire trop élevé."
    )]
    private $salaire;

    #[ORM\Column(type: 'date')]
    #[Assert\Type(
        type: "datetime",
        message: "{{ value }} invalide."
    )]
    #[Assert\LessThanOrEqual(
        value: "-18 years",
        message: "L'employé doit être majeur."
    )]
    #[Assert\GreaterThanOrEqual(
        value: "-100 years",
        message: "L'employé doit avoir moins de 100 ans."
    )]
    private $datedenaissance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getDatedenaissance(): ?\DateTimeInterface
    {
        return $this->datedenaissance;
    }

    public function setDatedenaissance(\DateTimeInterface $datedenaissance): self
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }
}
