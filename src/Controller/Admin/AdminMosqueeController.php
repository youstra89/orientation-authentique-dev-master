<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use App\Entity\Commune;
use App\Entity\Mosquee;
use App\Form\MosqueeType;
use App\Form\MosqueeSearchType;
use App\Entity\Search\MosqueeSearch;
use App\Repository\MosqueeRepository;
use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/mosquee")
 */
class AdminMosqueeController extends AbstractController
{
  /**
   * @Route("/", name="mosquees", methods="GET")
   */
  public function index(Request $request, PaginatorInterface $paginator): Response
  {
    $em = $this->getDoctrine()->getManager();
    $search = new MosqueeSearch();
    $form = $this->createForm(MosqueeSearchType::class, $search);
    $form->handleRequest($request);
    $repoMosquee = $em->getRepository(Mosquee::class);
    $mosquees = $paginator->paginate(
      $repoMosquee->myFindAllQuery($search),
      $request->query->getInt('page', 1),
      12
    );
    return $this->render('Admin/Mosquee/index.html.twig', [
      'mosquees' => $mosquees,
      'form'     => $form->createView()
    ]);
  }

  /**
   * @Route("/add", name="mosquee.add", methods="GET|POST")
   */
  public function mosquee_add(Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $mosquee = new Mosquee();
    $form = $this->createForm(MosqueeType::class, $mosquee);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
      if(empty($mosquee->getImam()) && (empty($mosquee->getNomImam()) || empty($mosquee->getNumeroImam())))
      {
        $this->addFlash('error', 'Une mosquée a forcément un imam. Veuillez bien remplir le formualire');
        return $this->redirectToRoute('mosquees');
      }
      $em->persist($mosquee);
      $em->flush();
      $this->addFlash('success', 'La mosquée '.$mosquee->getNom().' à '.$mosquee->getCommune()->getNom().' a été enregistré avec succès.');
      return $this->redirectToRoute('mosquees');
    }
    //>>
    return $this->render('Admin/Mosquee/mosquee-add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/edit/{id}", name="mosquee.edit", methods="GET|POST", requirements={"id"="\d+"})
   * @param Mosquee $mosquee
   */
  public function mosquee_edit(Request $request, Mosquee $mosquee): Response
  {
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(MosqueeType::class, $mosquee);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
      if(empty($mosquee->getImam()) && (empty($mosquee->getNomImam()) || empty($mosquee->getNumeroImam())))
      {
        $this->addFlash('error', 'Une mosquée a forcément un imam. Veuillez bien remplir le formualire');
        return $this->redirectToRoute('mosquee.edit', ['id' => $mosquee->getId()]);
      }
      $mosquee->setUpdatedAt(new \DateTime());
      $em->flush();
      $this->addFlash('success', 'Les informations sur la mosquée '.$mosquee->getNom().' à '.$mosquee->getCommune()->getNom().' ont été mises à jour avec succès.');
      return $this->redirectToRoute('mosquees');
    }
    //>>
    return $this->render('Admin/Mosquee/mosquee-edit.html.twig', [
      'form' => $form->createView(),
    ]);
  }


  /**
   * @Route("/information/{id}", name="mosquee.info", methods="GET", requirements={"id"="\d+"})
   * @param Mosquee $mosquee
   */
  public function mosquee_informations(Request $request, Mosquee $mosquee): Response
  {
    $em = $this->getDoctrine()->getManager();
    return $this->render('Admin/Mosquee/mosquee-info.html.twig', [
      'mosquee'  => $mosquee
    ]);
  }

}
