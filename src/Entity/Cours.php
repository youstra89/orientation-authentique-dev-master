<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 */
class Cours
{

    const JOURCOURS = [
      1 => 'Lundi',
      2 => 'Mardi',
      3 => 'Mercredi',
      4 => 'Jeudi',
      5 => 'Vendredi',
      6 => 'Samedi',
      7 => 'Dimanche',
    ];

    const HEURECOURS = [
      0 => 'Après Fadjr',
      1 => 'Après Zhour',
      2 => 'Après Asr',
      3 => 'Entre Maghreb et Icha',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Discipline", inversedBy="courses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $discipline;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mosquee", inversedBy="Courses")
     */
    private $mosquee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HDS", inversedBy="courses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hds;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Livre", inversedBy="courses")
     */
    private $livre;

    /**
     * @ORM\Column(type="string")
     */
    private $heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $annee_debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


    public function __construct()
    {
      $this->created_at = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscipline(): ?Discipline
    {
        return $this->discipline;
    }

    public function setDiscipline(?Discipline $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getMosquee(): ?Mosquee
    {
        return $this->mosquee;
    }

    public function setMosquee(?Mosquee $mosquee): self
    {
        $this->mosquee = $mosquee;

        return $this;
    }

    public function getHds(): ?HDS
    {
        return $this->hds;
    }

    public function setHds(?HDS $hds): self
    {
        $this->hds = $hds;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getHeureCoursType(): string
    {
      return self::HEURECOURS[$this->heure];
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getJourCoursType(): string
    {
      return self::JOURCOURS[$this->jour];
    }

    public function getAnneeDebut(): ?string
    {
        return $this->annee_debut;
    }

    public function setAnneeDebut(string $annee_debut): self
    {
        $this->annee_debut = $annee_debut;

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
