<?php

namespace App\Controller\Admin;

use App\Entity\HDS;
use App\Entity\Ecole;
use App\Entity\Cours;
use App\Entity\Livre;
use App\Entity\Ville;
use App\Entity\Region;
use App\Entity\Mosquee;
use App\Entity\Commune;
use App\Entity\Discipline;
use App\Repository\HDSRepository;
use App\Repository\EcoleRepository;
use App\Repository\CoursRepository;
use App\Repository\LivreRepository;
use App\Repository\VilleRepository;
use App\Repository\RegionRepository;
use App\Repository\MosqueeRepository;
use App\Repository\CommuneRepository;
use App\Repository\DisciplineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
  /**
   * @Route("/", name="admin", methods="GET")
   */
  public function index(ObjectManager $manager): Response
  {
    // $em = $this->getDoctrine()->getManager();
    $repoHDS        = $manager->getRepository(HDS::class);
    $repoEcole      = $manager->getRepository(Ecole::class);
    $repoCours      = $manager->getRepository(Cours::class);
    $repoLivre      = $manager->getRepository(Livre::class);
    $repoVille      = $manager->getRepository(Ville::class);
    $repoRegion     = $manager->getRepository(Region::class);
    $repoMosquee    = $manager->getRepository(Mosquee::class);
    $repoCommune    = $manager->getRepository(Commune::class);
    $repoDiscipline = $manager->getRepository(Discipline::class);

    $hommes      = $repoHDS->myCount();
    $ecoles      = $repoEcole->myCount();
    $courses     = $repoCours->myCount();
    $livres      = $repoLivre->myCount();
    $villes      = $repoVille->myCount();
    $regions     = $repoRegion->myCount();
    $mosquees    = $repoMosquee->myCount();
    $communes    = $repoCommune->myCount();
    $disciplines = $repoDiscipline->myCount();
    // dump($hommes);
    return $this->render('Admin/index.html.twig', [
      'hommes'      => $hommes,
      'ecoles'      => $ecoles,
      'courses'     => $courses,
      'livres'      => $livres,
      'villes'      => $villes,
      'regions'     => $regions,
      'mosquees'    => $mosquees,
      'communes'    => $communes,
      'disciplines' => $disciplines,
    ]);
  }
}
