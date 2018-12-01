<?php

namespace App\Controller\Admin;

use App\Entity\Discipline;
use App\Form\DisciplineType;
use App\Repository\DisciplineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/cours")
 */
class AdminDisciplineController extends AbstractController
{
  /**
   * @Route("/discipline", name="disciplines", methods="GET")
   */
  public function disciplines(Request $request, PaginatorInterface $paginator): Response
  {
    $em = $this->getDoctrine()->getManager();
    $repoDiscipline = $em->getRepository(Discipline::class);
    $disciplines = $paginator->paginate(
      $repoDiscipline->myFindAllQuery(),
      $request->query->getInt('page', 1),
      12
    );

    return $this->render('Admin/Discipline/index.html.twig', [
      'disciplines' => $disciplines
    ]);
  }

  /**
   * @Route("/discipline/add", name="discipline.add", methods="GET|POST")
   */
  public function discipline_add(Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $discipline = new Discipline();
    $form = $this->createForm(DisciplineType::class, $discipline);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $em->persist($discipline);
      $em->flush();
      $this->addFlash('success', 'La discipline a bien été enregistrée.');
      return $this->redirectToRoute('disciplines');
    }
    return $this->render('Admin/Discipline/discipline-add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/discipline/edit/{id<\d+>}", name="discipline.edit", methods="GET|POST")
   * @param Discipline $discipline
   */
  public function discipline_edit(Discipline $discipline, Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(DisciplineType::class, $discipline);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $discipline->setUpdatedAt(new \DateTime());
      $em->flush();
      $this->addFlash('success', 'Mise à jour de la discipline réussie.');
      return $this->redirectToRoute('disciplines');
    }
    return $this->render('Admin/Discipline/discipline-edit.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
