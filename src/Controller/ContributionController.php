<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class ContributionController extends AbstractController
{
  /**
   * @Route("/contribuer-a-orientation-authentique", name="contribution")
   */
    public function index()
    {
        return $this->render('Contribution/index.html.twig');
    }
}
