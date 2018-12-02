<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class OrientationController extends AbstractController
{
  /**
   * @Route("/reperes-chez-orientation-authentique", name="orientation")
   */
    public function index()
    {
        return $this->render('Orientation/index.html.twig');
    }
}
