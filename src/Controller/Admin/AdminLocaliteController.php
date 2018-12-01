<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use App\Form\RegionType;
use App\Entity\Ville;
use App\Form\VilleType;
use App\Entity\Commune;
use App\Form\CommuneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/localite")
 */
class AdminLocaliteController extends AbstractController
{
  /**
   * @Route("/", name="localite", methods="GET")
   */
  public function index(): Response
  {
    return $this->render('Admin/Localite/index.html.twig');
  }

  /**
   * @Route("/region", name="regions", methods="GET")
   */
  public function regions(Request $request, PaginatorInterface $paginator): Response
  {
    $em = $this->getDoctrine()->getManager();
    $repoRegion = $em->getRepository(Region::class);
    $regions = $paginator->paginate(
      $repoRegion->myFindAllQuery(),
      $request->query->getInt('page', 1),
      12
    );

    return $this->render('Admin/Localite/regions.html.twig', [
      'regions' => $regions
    ]);
  }

  /**
   * @Route("/region/add", name="region.add", methods="GET|POST")
   */
  public function region_add(Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $region = new Region();
    $form = $this->createForm(RegionType::class, $region);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $em->persist($region);
      $em->flush();
      $this->addFlash('success', 'La région a bien été enregistrée.');
      return $this->redirectToRoute('region.add');
    }
    return $this->render('Admin/Localite/region-add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/region/edit/{id<\d+>}", name="region.edit", methods="GET|POST")
   * @param Region $region
   */
  public function region_edit(Region $region, Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(RegionType::class, $region);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $region->setUpdatedAt(new \DateTime());
      $em->flush();
      $this->addFlash('success', 'Mise à jour de la region réussie.');
      return $this->redirectToRoute('regions');
    }
    return $this->render('Admin/Localite/région-edit.html.twig', [
      'form' => $form->createView()
    ]);
  }



    /**
     * @Route("/ville", name="villes", methods="GET")
     */
    public function villes(Request $request, PaginatorInterface $paginator): Response
    {
      $em = $this->getDoctrine()->getManager();
      $repoVille = $em->getRepository(Ville::class);
      $villes = $paginator->paginate(
        $repoVille->myFindAllQuery(),
        $request->query->getInt('page', 1),
        12
      );

      return $this->render('Admin/Localite/villes.html.twig', [
        'villes' => $villes
      ]);
    }

    /**
     * @Route("/ville/add", name="ville.add", methods="GET|POST")
     */
    public function ville_add(Request $request): Response
    {
      $em = $this->getDoctrine()->getManager();
      $ville = new Ville();
      $form = $this->createForm(VilleType::class, $ville);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
      {
        $em->persist($ville);
        $em->flush();
        $this->addFlash('success', 'La ville a bien été enregistrée.');
        return $this->redirectToRoute('ville.add');
      }
      return $this->render('Admin/Localite/ville-add.html.twig', [
        'form' => $form->createView()
      ]);
    }


    /**
     * @Route("/ville/edit/{id<\d+>}", name="ville.edit", methods="GET|POST")
     * @param Ville $ville
     */
    public function ville_edit(Ville $ville, Request $request): Response
    {
      $em = $this->getDoctrine()->getManager();
      $form = $this->createForm(VilleType::class, $ville);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
      {
        $ville->setUpdatedAt(new \DateTime());
        $em->flush();
        $this->addFlash('success', 'Mise à jour de la ville réussie.');
        return $this->redirectToRoute('villes');
      }
      return $this->render('Admin/Localite/ville-edit.html.twig', [
        'form' => $form->createView()
      ]);
    }



    /**
     * @Route("/commune", name="communes", methods="GET")
     */
    public function communes(Request $request, PaginatorInterface $paginator): Response
    {
      $em = $this->getDoctrine()->getManager();
      $repoCommune = $em->getRepository(Commune::class);
      $communes = $paginator->paginate(
        $repoCommune->myFindAllQuery(),
        $request->query->getInt('page', 1),
        12
      );

      return $this->render('Admin/Localite/communes.html.twig', [
        'communes' => $communes
      ]);
    }

    /**
     * @Route("/commune/add/{villeId<\d+>}", name="commune.add", methods="GET|POST")
     */
    public function commune_add(Request $request, int $villeId): Response
    {
      $em = $this->getDoctrine()->getManager();
      $repoVille = $em->getRepository(Ville::class);
      $ville = $repoVille->find($villeId);
      $commune = new Commune();
      $commune->setNom($ville->getNom());
      $commune->setVille($ville);
      $form = $this->createForm(CommuneType::class, $commune);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
      {
        $em->persist($commune);
        $em->flush();
        $this->addFlash('success', 'La commune a bien été enregistrée.');
        return $this->redirectToRoute('villes');
      }
      return $this->render('Admin/Localite/commune-add.html.twig', [
        'form' => $form->createView()
      ]);
    }


    /**
     * @Route("/commune/edit/{id<\d+>}", name="commune.edit", methods="GET|POST")
     * @param Commune $commune
     */
    public function commune_edit(Commune $commune, Request $request): Response
    {
      $em = $this->getDoctrine()->getManager();
      $form = $this->createForm(CommuneType::class, $commune);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid())
      {
        $commune->setUpdatedAt(new \DateTime());
        $em->flush();
        $this->addFlash('success', 'Mise à jour de la commune réussie.');
        return $this->redirectToRoute('communes');
      }
      return $this->render('Admin/Localite/commune-edit.html.twig', [
        'form' => $form->createView()
      ]);
    }
}
