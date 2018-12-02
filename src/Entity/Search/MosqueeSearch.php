<?php

namespace App\Entity\Search;

use App\Entity\Ville;
use App\Entity\Region;
use App\Entity\Commune;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class MosqueeSearch
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
   *@return MosqueeSearch
   */
  public function setNom(string $nom): MosqueeSearch
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
   *@return MosqueeSearch
   */
  public function setCommune(Commune $commune): MosqueeSearch
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
   *@return MosqueeSearch
   */
  public function setRegion(Region $region): MosqueeSearch
  {
    $this->region = $region;
    return $this;
  }

}
