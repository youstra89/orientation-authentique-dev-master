<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommuneRepository")
 * @UniqueEntity("nom")
 */
class Commune
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="communes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Regex("/^[0-9]{8}$/")
     */
    private $nombre_habitants;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Regex("/^[0-9]{8}$/")
     */
    private $taux_musulmans;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;


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

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNombreHabitants(): ?int
    {
        return $this->nombre_habitants;
    }

    public function setNombreHabitants(?int $nombre_habitants): self
    {
        $this->nombre_habitants = $nombre_habitants;

        return $this;
    }

    public function getTauxMusulmans(): ?int
    {
        return $this->taux_musulmans;
    }

    public function setTauxMusulmans(?int $taux_musulmans): self
    {
        $this->taux_musulmans = $taux_musulmans;

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
}
