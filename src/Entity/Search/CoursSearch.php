<?php

namespace App\Entity\Search;

use App\Entity\HDS;
use App\Entity\Ville;
use App\Entity\Region;
use App\Entity\Mosquee;
use App\Entity\Commune;
use App\Entity\Discipline;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class CoursSearch
{
  /**
   *@var string|null
   */
  private $hds;

  /**
   *@var Discipline|null
   */
  private $discipline;

  /**
   *@var Commune|null
   */
  private $commune;

  /**
   *@var Mosquee|null
   */
  private $mosquee;



  /**
   *@var string|null
   */
  public function getHds(): ?string
  {
    return $this->hds;
  }

  /**
   *@param string|null $hds
   *@return CoursSearch
   */
  public function setHds(string $hds): CoursSearch
  {
    $this->hds = $hds;
    return $this;
  }

  /**
   *@var Discipline|null
   */
  public function getDiscipline(): ?Discipline
  {
    return $this->discipline;
  }

  /**
   *@param Discipline|null $discipline
   *@return CoursSearch
   */
  public function setDiscipline(Discipline $discipline): CoursSearch
  {
    $this->discipline = $discipline;
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
   *@return CoursSearch
   */
  public function setCommune(Commune $commune): CoursSearch
  {
    $this->commune = $commune;
    return $this;
  }

  /**
   *@var Mosquee|null
   */
  public function getMosquee(): ?Mosquee
  {
    return $this->mosquee;
  }

  /**
   *@param Mosquee|null $mosquee
   *@return CoursSearch
   */
  public function setMosquee(Mosquee $mosquee): CoursSearch
  {
    $this->mosquee = $mosquee;
    return $this;
  }

}
