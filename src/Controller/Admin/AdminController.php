<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
  /**
   * @Route("/", name="admin", methods="GET")
   */
  public function index(): Response
  {
    return $this->render('Admin/index.html.twig');
  }
}
