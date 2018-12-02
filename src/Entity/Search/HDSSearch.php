<?php

namespace App\Entity\Search;

use App\Entity\Ville;
use App\Entity\Region;
use App\Entity\Commune;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class HDSSearch
{
  /**
   *@var string|null
   */
  private $nom;

  /**
   *@var Commune|null
   */
  private $commune;

  /**
   *@var Region|null
   */
  private $region;


  /**
   *@var string|null
   */
  public function getNom(): ?string
  {
    return $this->nom;
  }

  /**
   *@param string|null $nom
   *@return HDSSearch
   */
  public function setNom(string $nom): HDSSearch
  {
    $this->nom = $nom;
    return $this;
  }

  /**
   *@var Commune|null
   */
  public function getCommune(): ?Commune
  {
    return $this->commune;
  }

  /**
   *@param Commune|null $commune
   *@return HDSSearch
   */
  public function setCommune(Commune $commune): HDSSearch
  {
    $this->commune = $commune;
    return $this;
  }

  /**
   *@var Region|null
   */
  public function getRegion(): ?Region
  {
    return $this->region;
  }

  /**
   *@param Region|null $region
   *@return HDSSearch
   */
  public function setRegion(Region $region): HDSSearch
  {
    $this->region = $region;
    return $this;
  }

}
