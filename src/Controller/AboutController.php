<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AboutController extends AbstractController
{
  /**
   * @Route("/a-propos-du-projet-orientation-authentique", name="about")
   */
    public function index()
    {
        return $this->render('About/index.html.twig');
    }
}
