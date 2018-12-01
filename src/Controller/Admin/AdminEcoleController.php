<?php

namespace App\Controller\Admin;

use App\Entity\Ecole;
use App\Form\EcoleType;
use App\Entity\Commune;
use App\Repository\EcoleRepository;
use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/ecole")
 */
class AdminEcoleController extends AbstractController
{
  /**
   * @Route("/", name="ecoles", methods="GET")
   */
  public function index(Request $request, PaginatorInterface $paginator): Response
  {
    $em = $this->getDoctrine()->getManager();
    $repoEcole = $em->getRepository(Ecole::class);
    $ecoles = $paginator->paginate(
      $repoEcole->myFindAllQuery(),
      $request->query->getInt('page', 1),
      12
    );
    return $this->render('Admin/Ecole/index.html.twig', [
      'ecoles' => $ecoles
    ]);
  }

  /**
   * @Route("/add", name="ecole.add", methods="GET|POST")
   */
  public function ecole_add(Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $ecole = new Ecole();
    $form = $this->createForm(EcoleType::class, $ecole);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
      if(empty($ecole->getDirector()) && (empty($ecole->getDirectorName()) || empty($ecole->getDirectorNumber())))
      {
        $this->addFlash('error', 'Une école a forcément un directeur. Veuillez bien remplir le formualire');
        return $this->redirectToRoute('ecoles');
      }
      $em->persist($ecole);
      $em->flush();
      $this->addFlash('success', 'L\'école '.$ecole->getNom().' à '.$ecole->getCommune()->getNom().' a été enregistré avec succès.');
      return $this->redirectToRoute('ecoles');
    }
    //>>
    return $this->render('Admin/Ecole/ecole-add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/edit/{id}", name="ecole.edit", methods="GET|POST", requirements={"id"="\d+"})
   * @param Ecole $ecole
   */
  public function ecole_edit(Request $request, Ecole $ecole): Response
  {
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(EcoleType::class, $ecole);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
      if(empty($ecole->getDirector()) && (empty($ecole->getDirectorName()) || empty($ecole->getDirectorNumber())))
      {
        $this->addFlash('error', 'Une école a forcément un directeur. Veuillez bien remplir le formualire');
        return $this->redirectToRoute('ecole.edit', ['id' => $ecole->getId()]);
      }
      $ecole->setUpdatedAt(new \DateTime());
      $em->flush();
      $this->addFlash('success', 'L\'école '.$ecole->getNom().' à '.$ecole->getCommune()->getNom().' ont été mises à jour avec succès.');
      return $this->redirectToRoute('ecoles');
    }
    //>>
    return $this->render('Admin/Ecole/ecole-edit.html.twig', [
      'form'  => $form->createView(),
      'ecole' => $ecole
    ]);
  }


  /**
   * @Route("/information/{id}", name="ecole.info", methods="GET", requirements={"id"="\d+"})
   * @param Ecole $ecole
   */
  public function ecole_information(Request $request, Ecole $ecole): Response
  {
    $em = $this->getDoctrine()->getManager();
    return $this->render('Admin/Ecole/ecole-info.html.twig', [
      'ecole'  => $ecole
    ]);
  }

}
