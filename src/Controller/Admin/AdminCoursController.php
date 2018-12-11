<?php

namespace App\Controller\Admin;

use App\Entity\HDS;
use App\Entity\Search\CoursSearch;
use App\Entity\Cours;
use App\Entity\Mosquee;
use App\Form\CoursType;
use App\Form\CoursSearchType;
use App\Repository\HDSRepository;
use App\Repository\CoursRepository;
use App\Repository\MosqueeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/cours")
 */
class AdminCoursController extends AbstractController
{
  /**
   * @Route("/", name="courses", methods="GET")
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function index(Request $request, PaginatorInterface $paginator): Response
  {
    $em = $this->getDoctrine()->getManager();
    $search = new CoursSearch();
    $form = $this->createForm(CoursSearchType::class, $search);
    $form->handleRequest($request);
    $repoCours = $em->getRepository(Cours::class);
    $courses = $paginator->paginate(
      $repoCours->myFindAllQuery($search),
      $request->query->getInt('page', 1),
      12
    );
    return $this->render('Admin/Cours/index.html.twig', [
      'courses' => $courses,
      'form'   => $form->createView()
    ]);
  }

  /**
   * @Route("/hds-pour-enregistrement-cours", name="cours.add.select.hds", methods="GET")
   * @Security("has_role('ROLE_EDITEUR')")
   */
  public function cours_add_select_hds(Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $hommes = $em->getRepository(HDS::class)->findAll();
    return $this->render('Admin/Cours/cours-add-select-hds.html.twig', [
      'hommes' => $hommes
    ]);
  }

  /**
   * @Route("/mosquee-pour-enregistrement-cours/hds-{id}", name="cours.add.select.mosquee", methods="GET")
   * @Security("has_role('ROLE_EDITEUR')")
   * @param HDS $hds
   */
  public function cours_add_select_mosquee(Request $request, HDS $hds): Response
  {
    $em = $this->getDoctrine()->getManager();
    $mosquees = $em->getRepository(Mosquee::class)->findAll();
    return $this->render('Admin/Cours/cours-add-select-mosquee.html.twig', [
      'mosquees' => $mosquees,
      'hds'      => $hds
    ]);
  }

  /**
   * @Route("/add-hds-{hdsId}-mosquee-{id}", name="cours.add", methods="GET|POST", requirements={"hdsId"="\d+", "id"="\d+"})
   * @Security("has_role('ROLE_EDITEUR')")
   * @param Mosquee $mosquee
   */
  public function cours_add(Request $request, Mosquee $mosquee, int $hdsId): Response
  {
    $em = $this->getDoctrine()->getManager();
    $repoHDS = $em->getRepository(HDS::class);
    $repoCours = $em->getRepository(Cours::class);
    $repoMosquee = $em->getRepository(Mosquee::class);
    $hds = $repoHDS->find($hdsId);
    $cours = new Cours();
    $cours->setHds($hds);
    $cours->setMosquee($mosquee);
    $form = $this->createForm(CoursType::class, $cours);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      /* Avant d'enregistrer un cours, plusierus vérification doivent être faites:
       *  1 - On vérifie que l'hds et la mosquée sont dans la même commune, où la même région
       *  2 - On vérifie ensuite la disponibilité de l'hds pour le jour et l'heure choisis
       *  3 - Et enfin, on vérifie la disponibilité de la mosquée pour le jour et l'heure choisis
       */

      // Première vérification
      if($hds->getCommune()->getId() !== $mosquee->getCommune()->getId())
      {
        /* On entre dans cette condition si hds et la mosquée ne sont pas dans la même commune
         *  Il y a alors deux cas possibles:
         *    1 - l'hds et la mosquée sont à Abidjan, auquel cas, on enregistre
         *    2 - l'un des deux ou même tous les deux ne sont pas à Abidjan, auquel cas en rejette
         */
         if($hds->getCommune()->getVille()->getRegion()->getId() === $mosquee->getCommune()->getVille()->getRegion()->getId() && $mosquee->getCommune()->getVille()->getNom() === 'Abidjan')
         {
           // Deuxième vérification
           // Disponibilité hds pour le jour et l'heure choisis
           $coursHDS = $repoCours->findBy(['hds_id' => $hdsId, 'jour' => $cours->getJour(), 'heure' => $cours->getHeure()]);
           if(!empty($coursHDS))
           {
             $this->addFlash('error', $hds->getPnom().' '.$hds->getNom().' n\'est pas disponible ce jour à cette heure. Il a déjà un autre cours.');
             return $this->redirectToRoute('cours.add', ['hdsId' => $hdsId, 'id' => $mosquee->getId()]);
           }

           // Troisième vérification
           // Disponibilité mosquee pour le jour et l'heure choisis
           $coursMosquee = $repoCours->findBy(['mosquee_id' => $mosquee->getId(), 'jour' => $cours->getJour(), 'heure' => $cours->getHeure()]);
           if(!empty($coursMosquee))
           {
             $this->addFlash('error', 'La mosquée n\'est pas disponible ce jour à cette heure. Il y a un autre cours à cette heure.');
             return $this->redirectToRoute('cours.add', ['hdsId' => $hdsId, 'id' => $mosquee->getId()]);
           }
           $em->persist($cours);
           $this->addFlash('success', 'La cours a bien été enregistrée.');
         }
         else{
           $this->addFlash('error', 'L\'homme de science et la mosquée doivent être de la même commune, sauf ceux d\'Abidjan qui peuvent être dans des communes différentes.');
           return $this->redirectToRoute('cours.add.select.mosquee', ['id' => $hdsId]);
         }
      }
      else{
        // Deuxième vérification
        // Disponibilité hds pour le jour et l'heure choisis
        $coursHds = $repoCours->findBy(['hds' => $hdsId, 'jour' => $cours->getJour(), 'heure' => $cours->getHeure()]);
        if(!empty($coursHds))
        {
          $this->addFlash('error', $hds->getPnom().' '.$hds->getNom().' n\'est pas disponible ce jour à cette heure. Il a déjà un autre cours.');
          return $this->redirectToRoute('cours.add', ['hdsId' => $hdsId, 'id' => $mosquee->getId()]);
        }

        // Troisième vérification
        // Disponibilité mosquee pour le jour et l'heure choisis
        $coursMosquee = $repoCours->findBy(['mosquee' => $mosquee->getId(), 'jour' => $cours->getJour(), 'heure' => $cours->getHeure()]);
        dump($coursMosquee);
        if(!empty($coursMosquee))
        {
          $this->addFlash('error', 'La mosquée n\'est pas disponible ce jour à cette heure. Il y a un autre cours à cette heure.');
          return $this->redirectToRoute('cours.add', ['hdsId' => $hdsId, 'id' => $mosquee->getId()]);
        }
        $em->persist($cours);
        $this->addFlash('success', 'La cours a bien été enregistrée.');
      }
      $em->flush();
      return $this->redirectToRoute('courses');
    }
    return $this->render('Admin/Cours/cours-add.html.twig', [
      'form'    => $form->createView(),
      'mosquee' => $mosquee,
      'hds'     => $hds,
    ]);
  }

  /**
   * @Route("/edit/{id<\d+>}", name="cours.edit", methods="GET|POST")
   * @Security("has_role('ROLE_EDITEUR')")
   * @param Cours $cours
   */
  public function cours_edit(Cours $cours, Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(CoursType::class, $cours);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $cours->setUpdatedAt(new \DateTime());
      $em->flush();
      $this->addFlash('success', 'Mise à jour de la cours réussie.');
      return $this->redirectToRoute('courses');
    }
    return $this->render('Admin/Cours/cours-edit.html.twig', [
      'form'  => $form->createView(),
      'cours' => $cours,
    ]);
  }

  /**
   * @Route("/details/{id<\d+>}", name="cours.details", methods="GET")
   * @Security("has_role('ROLE_ADMIN')")
   * @param Cours $cours
   */
  public function cours_details(Cours $cours, Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();

    return $this->render('Admin/Cours/cours-detail.html.twig', [
      'cours' => $cours
    ]);
  }
}
