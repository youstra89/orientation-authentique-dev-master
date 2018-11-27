<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class MainController extends AbstractController
{
  // /**
  //  * Matches /blog exactly
  //  *
  //  * @Route("/blog", name="blog_list")
  //  */
    public function index()
    {

        return $this->render('Home/index.html.twig', [
        ]);
    }
}
