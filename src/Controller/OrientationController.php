<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\HDS;
use App\Entity\Ecole;
use App\Entity\Cours;
use App\Entity\Mosquee;
use App\Entity\Search\HDSSearch;
use App\Entity\Search\EcoleSearch;
use App\Entity\Search\CoursSearch;
use App\Entity\Search\MosqueeSearch;
use App\Form\HDSSearchType;
use App\Form\EcoleSearchType;
use App\Form\CoursSearchType;
use App\Form\MosqueeSearchType;
use App\Repository\HDSRepository;
use App\Repository\EcoleRepository;
use App\Repository\CoursRepository;
use App\Repository\MosqueeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

use Knp\Component\Pager\PaginatorInterface;

use Doctrine\Common\Persistence\ObjectManager;

/**
 * @Route("/orientations")
 */
class OrientationController extends AbstractController
{
  /**
   * @Route("/", name="orientation")
   */
    public function index()
    {
        return $this->render('Orientation/index.html.twig');
    }

    /**
     * @Route("/cours", name="orientation.cours", methods="GET")
     */
    public function cours(Request $request, PaginatorInterface $paginator, ObjectManager $manager): Response
    {
      $search = new CoursSearch();
      $form = $this->createForm(CoursSearchType::class, $search);
      $form->handleRequest($request);
      $repoCours = $manager->getRepository(Cours::class);
      $courses = $paginator->paginate(
        $repoCours->myFindAllQuery($search),
        $request->query->getInt('page', 1),
        12
      );
      return $this->render('Orientation/cours.html.twig', [
        'courses' => $courses,
        'form'   => $form->createView()
      ]);
    }

    /**
     * @Route("/ecoles", name="orientation.ecoles", methods="GET")
     */
    public function ecoles(Request $request, PaginatorInterface $paginator, ObjectManager $manager): Response
    {
      $search = new EcoleSearch();
      $form = $this->createForm(EcoleSearchType::class, $search);
      $form->handleRequest($request);
      $repoEcole = $manager->getRepository(Ecole::class);
      $ecoles = $paginator->paginate(
        $repoEcole->myFindAllQuery($search),
        $request->query->getInt('page', 1),
        12
      );
      return $this->render('Orientation/ecoles.html.twig', [
        'ecoles' => $ecoles,
        'form'   => $form->createView()
      ]);
    }

    /**
     * @Route("/ecoles/information/{id}", name="orientation.ecole.info", methods="GET", requirements={"id"="\d+"})
     * @param Ecole $ecole
     */
    public function ecole_information(Request $request, Ecole $ecole): Response
    {
      $em = $this->getDoctrine()->getManager();
      return $this->render('Orientation/ecole-info.html.twig', [
        'ecole'  => $ecole
      ]);
    }

    /**
     * @Route("/hommes-de-science", name="orientation.hds", methods="GET")
     */
    public function hds(Request $request, PaginatorInterface $paginator, ObjectManager $manager): Response
    {
      $search = new HDSSearch();
      $form = $this->createForm(HDSSearchType::class, $search);
      $form->handleRequest($request);
      $repoHDS = $manager->getRepository(HDS::class);
      $hommes = $paginator->paginate(
        $repoHDS->myFindAllQuery($search),
        $request->query->getInt('page', 1),
        12
      );
      return $this->render('Orientation/hds.html.twig', [
        'hommes' => $hommes,
        'form'   => $form->createView()
      ]);
    }

    /**
     * @Route("/hommes-de-science/biobgraphie/{id}", name="orientation.hds.biographie", requirements={"id"="\d+"}, methods="GET")
     */
    public function hds_biographie(Request $request, HDS $hds): Response
    {
      if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      // if (!$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
        $request->getSession()->getFlashBag()->add('warning', 'Avant de lire la biographie d\'un homme de science, vous devez vous inscrire.');
        return $this->redirectToRoute('login');
      }
      $em = $this->getDoctrine()->getManager();
      $repoCours = $em->getRepository(Cours::class);
      $courses = $repoCours->findBy(['hds' => $hds->getId()]);

      return $this->render('Orientation/hds-biographie.html.twig', [
        'hds'     => $hds,
        'courses' => $courses,
      ]);
    }

    /**
     * @Route("/mosquees", name="orientation.mosquees", methods="GET")
     */
    public function mosquees(Request $request, PaginatorInterface $paginator, ObjectManager $manager): Response
    {
      $search = new MosqueeSearch();
      $form = $this->createForm(MosqueeSearchType::class, $search);
      $form->handleRequest($request);
      $repoMosquee = $manager->getRepository(Mosquee::class);
      $mosquees = $paginator->paginate(
        $repoMosquee->myFindAllQuery($search),
        $request->query->getInt('page', 1),
        12
      );
      return $this->render('Orientation/mosquees.html.twig', [
        'mosquees' => $mosquees,
        'form'     => $form->createView()
      ]);
    }

    /**
     * @Route("/mosquees/information/{id}", name="orientation.mosquee.info", methods="GET", requirements={"id"="\d+"})
     * @param Mosquee $mosquee
     */
    public function mosquee_informations(Request $request, Mosquee $mosquee): Response
    {
      $em = $this->getDoctrine()->getManager();
      $repoCours = $em->getRepository(Cours::class);
      $courses = $repoCours->findBy(['mosquee' => $mosquee->getId()]);
      return $this->render('Orientation/mosquee-info.html.twig', [
        'mosquee'  => $mosquee,
        'courses'  => $courses,
      ]);
    }
}
