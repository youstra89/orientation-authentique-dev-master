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
}
