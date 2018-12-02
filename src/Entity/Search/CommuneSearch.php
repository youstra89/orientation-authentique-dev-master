<?php

namespace App\Entity\Search;

use App\Entity\Region;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class CommuneSearch
{
  /**
   *@var string|null
   */
  private $nom;

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
   *@return CommuneSearch
   */
  public function setNom(string $nom): CommuneSearch
  {
    $this->nom = $nom;
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
   *@return CommuneSearch
   */
  public function setRegion(Region $region): CommuneSearch
  {
    $this->region = $region;
    return $this;
  }

}
