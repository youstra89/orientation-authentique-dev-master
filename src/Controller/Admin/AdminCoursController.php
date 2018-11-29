<?php

namespace App\Controller\Admin;

use App\Entity\HDS;
use App\Entity\Cours;
use App\Entity\Mosquee;
use App\Form\CoursType;
use App\Repository\HDSRepository;
use App\Repository\CoursRepository;
use App\Repository\MosqueeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cours")
 */
class AdminCoursController extends AbstractController
{
  /**
   * @Route("/", name="courses", methods="GET")
   */
  public function index(): Response
  {
    $courses  = $this->getDoctrine()->getManager()->getRepository(Cours::class)->findAll();
    return $this->render('Admin/Cours/index.html.twig', [
      'courses' => $courses
    ]);
  }

  /**
   * @Route("/hds-pour-enregistrement-cours", name="cours.add.select.hds", methods="GET")
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
   * @param Mosquee $mosquee
   */
  public function cours_add(Request $request, Mosquee $mosquee, int $hdsId): Response
  {
    $em = $this->getDoctrine()->getManager();
    $hds = $em->getRepository(HDS::class)->find($hdsId);
    $cours = new Cours();
    $cours->setHds($hds);
    $cours->setMosquee($mosquee);
    $form = $this->createForm(CoursType::class, $cours);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $em->persist($cours);
      $em->flush();
      $this->addFlash('success', 'La cours a bien été enregistrée.');
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
