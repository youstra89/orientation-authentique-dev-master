<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class ContactController extends AbstractController
{
  /**
   * @Route("/contacter-orientation-authentique", name="contact")
   */
    public function index()
    {
        return $this->render('Contact/index.html.twig');
    }
}
