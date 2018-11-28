<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MosqueeRepository")
 * @UniqueEntity("nom")
 */
class Mosquee
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Commune", inversedBy="mosquees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commune;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=255)
     */
    private $quartier;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\HDS", cascade={"persist", "remove"})
     */
    private $imam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_imam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero_imam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $responsable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero_responsable;

    /**
     * @ORM\Column(type="boolean")
     */
    private $djoumoua = 0;

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
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    public function __construct()
    {
      $this->created_at = new \Datetime();
      $this->updated_at = new \Datetime();
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

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

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

    public function getImam(): ?HDS
    {
        return $this->imam;
    }

    public function setImam(?HDS $imam): self
    {
        $this->imam = $imam;

        return $this;
    }

    public function getNomImam(): ?string
    {
        return $this->nom_imam;
    }

    public function setNomImam(?string $nom_imam): self
    {
        $this->nom_imam = $nom_imam;

        return $this;
    }

    public function getNumeroImam(): ?string
    {
        return $this->numero_imam;
    }

    public function setNumeroImam(?string $numero_imam): self
    {
        $this->numero_imam = $numero_imam;

        return $this;
    }

    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(?string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getNumeroResponsable(): ?string
    {
        return $this->numero_responsable;
    }

    public function setNumeroResponsable(?string $numero_responsable): self
    {
        $this->numero_responsable = $numero_responsable;

        return $this;
    }

    public function getDjoumoua(): ?bool
    {
        return $this->djoumoua;
    }

    public function setDjoumoua(bool $djoumoua): self
    {
        $this->djoumoua = $djoumoua;

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
}
