<?php

namespace App\Controller\Admin;

use App\Entity\HDS;
use App\Entity\User;
use App\Entity\Ecole;
use App\Entity\Cours;
use App\Entity\Livre;
use App\Entity\Ville;
use App\Entity\Region;
use App\Entity\Message;
use App\Entity\Mosquee;
use App\Entity\Commune;
use App\Entity\Discipline;
use App\Repository\HDSRepository;
use App\Repository\EcoleRepository;
use App\Repository\CoursRepository;
use App\Repository\LivreRepository;
use App\Repository\VilleRepository;
use App\Repository\RegionRepository;
use App\Repository\MosqueeRepository;
use App\Repository\CommuneRepository;
use App\Repository\DisciplineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends AbstractController
{
  /**
   * @Route("/", name="admin", methods="GET")
   */
  public function index(ObjectManager $manager): Response
  {
    // $em = $this->getDoctrine()->getManager();
    $repoHDS        = $manager->getRepository(HDS::class);
    $repoEcole      = $manager->getRepository(Ecole::class);
    $repoCours      = $manager->getRepository(Cours::class);
    $repoLivre      = $manager->getRepository(Livre::class);
    $repoVille      = $manager->getRepository(Ville::class);
    $repoRegion     = $manager->getRepository(Region::class);
    $repoMosquee    = $manager->getRepository(Mosquee::class);
    $repoCommune    = $manager->getRepository(Commune::class);
    $repoDiscipline = $manager->getRepository(Discipline::class);

    $hommes      = $repoHDS->myCount();
    $ecoles      = $repoEcole->myCount();
    $courses     = $repoCours->myCount();
    $livres      = $repoLivre->myCount();
    $villes      = $repoVille->myCount();
    $regions     = $repoRegion->myCount();
    $mosquees    = $repoMosquee->myCount();
    $communes    = $repoCommune->myCount();
    $disciplines = $repoDiscipline->myCount();
    // dump($hommes);
    return $this->render('Admin/index.html.twig', [
      'hommes'      => $hommes,
      'ecoles'      => $ecoles,
      'courses'     => $courses,
      'livres'      => $livres,
      'villes'      => $villes,
      'regions'     => $regions,
      'mosquees'    => $mosquees,
      'communes'    => $communes,
      'disciplines' => $disciplines,
    ]);
  }

  /**
   *@Route("/messages", name="messages")
   */
  public function messages(Request $request, ObjectManager $em, PaginatorInterface $paginator)
  {
    $repoMessage = $em->getRepository(Message::class);
    $messages = $paginator->paginate(
      $repoMessage->messagesSelectQuery(),
      $request->query->getInt('page', 1),
      20
    );

    return $this->render('Admin/messages.html.twig', [
      'messages' => $messages
    ]);
  }


  /**
   *@Route("/messages/read/{id}", name="message.read", requirements={"id"="\d+"})
   * @param Message $message
   */
  public function message_read(Request $request, ObjectManager $em, Message $message)
  {
    if (empty($message->getReadAt())) {
      // code...
      $user = $this->getUser();
      $message->setReadAt(new \DateTime());
      $message->setReader($user);
      $em->flush();
    }
    return $this->render('Admin/read-message.html.twig', [
      'message' => $message
    ]);
  }

  /**
   * @Route("/envoi-de-mail", name="mail")
   */
  public function mail(\Swift_Mailer $mailer)
  {
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(User::class)->find(1);

    $url = $this->generateUrl('activation_compte', ['token' => $user->getToken()], UrlGeneratorInterface::ABSOLUTE_URL);
    // dump($url);

    $message = (new \Swift_Message('Activation de compte Orientation Authentique'))
        ->setFrom('contact.youstra@gmail.com')
        ->setTo($user->getEmail())
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'Emails/registration.html.twig', [
                'url'  => $url,
                'user' => $user
              ]
            ),
            'text/html'
        );
    $mailer->send($message);

    $this->addFlash('success', 'Mail envoyé.');
    return $this->redirectToRoute('admin');
  }
}
