<?php

namespace App\Controller\Admin;

use App\Entity\HDS;
use App\Entity\Cours;
use App\Entity\Search\HDSSearch;
use App\Form\HDSType;
use App\Form\HDSSearchType;
use App\Entity\Commune;
use App\Repository\HDSRepository;
use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/hommes-de-science")
 */
class AdminHDSController extends AbstractController
{
  /**
   * @Route("/", name="hds", methods="GET")
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function index(Request $request, PaginatorInterface $paginator): Response
  {
    $em = $this->getDoctrine()->getManager();
    $search = new HDSSearch();
    $form = $this->createForm(HDSSearchType::class, $search);
    $form->handleRequest($request);
    $repoHDS = $em->getRepository(HDS::class);
    $hommes = $paginator->paginate(
      $repoHDS->myFindAllQuery($search),
      $request->query->getInt('page', 1),
      12
    );
    return $this->render('Admin/HDS/index.html.twig', [
      'hommes' => $hommes,
      'form'   => $form->createView()
    ]);
  }

  /**
   * @Route("/add", name="hds.add", methods="GET|POST")
   * @Security("has_role('ROLE_EDITEUR')")
   */
  public function hds_add(Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $hds = new HDS();
    $form = $this->createForm(HDSType::class, $hds);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
      $data = $request->request->all();
      $biographie = $data['biographie'];
      $dateNaissance = $data['date'];
      if(empty($biographie))
      {
        $this->addFlash('error', 'Vous n\'avez pas fait la biographie de notre homme de science.');
        return $this->redirectToRoute('hds');
      }

      $hds->setDateNaissance(new \DateTime($dateNaissance));
      $hds->setBiographie($biographie);
      $em->persist($hds);
      $em->flush();
      $this->addFlash('success', $hds->getPnom().' '.$hds->getNom().' a été enregistré avec succès.');
      return $this->redirectToRoute('hds');
    }
    //>>
    return $this->render('Admin/HDS/hds-add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/edit/{id}", name="hds.edit", methods="GET|POST", requirements={"id"="\d+"})
   * @Security("has_role('ROLE_EDITEUR')")
   * @param HDS $hds
   */
  public function hds_edit(Request $request, HDS $hds): Response
  {
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(HDSType::class, $hds);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid())
    {
      $data = $request->request->all();
      $biographie = $data['biographie'];
      $dateNaissance = $data['date'];
      if(empty($biographie))
      {
        $this->addFlash('error', 'Vous n\'avez pas fait la biographie de notre homme de science.');
        return $this->redirectToRoute('hds');
      }

      $hds->setDateNaissance(new \DateTime($dateNaissance));
      $hds->setBiographie($biographie);
      $hds->setUpdatedAt(new \DateTime());
      $em->flush();
      $this->addFlash('success', 'Les informations de '.$hds->getPnom().' '.$hds->getNom().' ont été mises à jour avec succès.');
      return $this->redirectToRoute('hds');
    }
    //>>
    return $this->render('Admin/HDS/hds-edit.html.twig', [
      'form' => $form->createView(),
      'hds'  => $hds
    ]);
  }

  /**
   * @Route("/biographie/{id}", name="hds.biographie", methods="GET", requirements={"id"="\d+"})
   * @Security("has_role('ROLE_ADMIN')")
   * @param HDS $hds
   */
  public function hds_biongraphie(Request $request, HDS $hds): Response
  {
    $em = $this->getDoctrine()->getManager();
    $repoCours = $em->getRepository(Cours::class);
    $courses = $repoCours->findBy(['hds' => $hds->getId()]);

    return $this->render('Admin/HDS/hds-biographie.html.twig', [
      'hds'      => $hds,
      'courses'  => $courses,
    ]);
  }

  /**
   * @Route("/select-request", name="select.hds", methods="GET")
   */
  public function hds_select_request(Request $request): JsonResponse
  {
    $em = $this->getDoctrine()->getManager();
    $id = $request->query->get('hds');
    $hds = $em->getRepository(HDS::class)->find($id);

    $h['id']     = $hds->getId();
    $h['name']   = $hds->getPnom().' '.$hds->getNom();
    $h['number'] = $hds->getNumero();
    $response = new JsonResponse($h);
    return $response;
  }
}
