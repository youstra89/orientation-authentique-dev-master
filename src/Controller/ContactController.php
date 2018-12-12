<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class ContactController extends AbstractController
{
  /**
   * @Route("/contacter-orientation-authentique", name="contact")
   */
    public function index(Request $request, ObjectManager $manager)
    {
      $message = new Message();
      if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
      {
        $user = $this->getUser();
        $message->setFullname($user->getNom().' '.$user->getPnom());
        $message->setEmail($user->getEmail());
        $message->setPhoneNumber($user->getPhoneNumber());
      }
      $form = $this->createForm(MessageType::class, $message);
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {

        $manager->persist($message);
        $manager->flush();
        $this->addFlash('success', 'Votre message a été envoyé avec succès. Un membre de l\'équipe Orientation Authentique vous répondra dans les plus brefs délais');
        return $this->redirectToRoute('contact');
      }
      return $this->render('Contact/index.html.twig', [
        'form' => $form->createView()
      ]);
    }
}
