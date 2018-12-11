<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/cours")
 */
class AdminLivreController extends AbstractController
{
  /**
   * @Route("/livre", name="livres", methods="GET")
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function livres(Request $request, PaginatorInterface $paginator): Response
  {
    $em = $this->getDoctrine()->getManager();
    $repoLivre = $em->getRepository(Livre::class);
    $livres = $paginator->paginate(
      $repoLivre->myFindAllQuery(),
      $request->query->getInt('page', 1),
      12
    );

    return $this->render('Admin/Livre/index.html.twig', [
      'livres' => $livres
    ]);
  }

  /**
   * @Route("/livre/add", name="livre.add", methods="GET|POST")
   * @Security("has_role('ROLE_EDITEUR')")
   */
  public function livre_add(Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $livre = new Livre();
    $form = $this->createForm(LivreType::class, $livre);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $em->persist($livre);
      $em->flush();
      $this->addFlash('success', 'La livre a bien été enregistrée.');
      return $this->redirectToRoute('livres');
    }
    return $this->render('Admin/Livre/livre-add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/livre/edit/{id<\d+>}", name="livre.edit", methods="GET|POST")
   * @Security("has_role('ROLE_EDITEUR')")
   * @param Livre $livre
   */
  public function livre_edit(Livre $livre, Request $request): Response
  {
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(LivreType::class, $livre);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $livre->setUpdatedAt(new \DateTime());
      $em->flush();
      $this->addFlash('success', 'Mise à jour de la livre réussie.');
      return $this->redirectToRoute('livres');
    }
    return $this->render('Admin/Livre/livre-edit.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
