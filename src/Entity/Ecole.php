<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcoleRepository")
 */
class Ecole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commune;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HDS", inversedBy="ecoles")
     */
    private $director;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $director_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $director_number;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]{4}$/")
     */
    private $annee_construction;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quartier;


    public function __construct()
    {
      $this->created_at = new \Datetime();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getDirector(): ?HDS
    {
        return $this->director;
    }

    public function setDirector(?HDS $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getDirectorName(): ?string
    {
        return $this->director_name;
    }

    public function setDirectorName(?string $director_name): self
    {
        $this->director_name = $director_name;

        return $this;
    }

    public function getDirectorNumber(): ?string
    {
        return $this->director_number;
    }

    public function setDirectorNumber(string $director_number): self
    {
        $this->director_number = $director_number;

        return $this;
    }

    public function getAnneeConstruction(): ?string
    {
        return $this->annee_construction;
    }

    public function setAnneeConstruction(string $annee_construction): self
    {
        $this->annee_construction = $annee_construction;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(string $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }
}
