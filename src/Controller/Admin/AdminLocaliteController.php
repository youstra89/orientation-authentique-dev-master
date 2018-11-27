<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use App\Form\RegionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
   * @Route("/region/add", name="region.add", methods="GET")
   */
  public function region_add(): Response
  {
    $em = $this->getDoctrine()->getManager();
    $region = new Region();
    $form = $this->createForm(RegionType::class, $region);
    return $this->render('Admin/Localite/region-add.html.twig', [
      'form' => $form->createView()
    ]);
  }

}
