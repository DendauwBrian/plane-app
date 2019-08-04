<?php


namespace App\Controller;

use App\Entity\Pilot;
use App\Entity\Flight;

use App\Form\PilotFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PilotController extends AbstractController
{
    /**
     * @Route("/pilots", name="pilots");
     */
    public function index()
    {
        $user = $this->getUser();
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 0, 'user' => $user));

        return $this->render('pilots/index.html.twig', [
            "retired_view" => false,
            "pilots" => $pilots
        ]);
    }

    /**
     * @Route("/pilots/retired", name="retiredPilots");
     */
    public function retiredIndex()
    {
        $user = $this->getUser();
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 1, 'user' => $user));

        return $this->render('pilots/index.html.twig', [
            "retired_view" => true,
            "pilots" => $pilots
        ]);
    }

    /**
     * @Route("/pilot/new", name="newPilot");
     * Method({"GET", "POST"})
     */
    public function create(Request $request)
    {
        $pilot = new Pilot();
        $form = $this->createForm(PilotFormType::class, $pilot);
        $form->add("save", SubmitType::class, array('label' => 'Create', 'attr' => array("class" => "btn btn-primary")));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pilot = $form->getData();
            $pilot->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($pilot);
            $em->flush();

            return $this->redirectToRoute('pilots');
        }

        return $this->render('pilots/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/pilot/edit/{id}", name="editAPilot");
     */
    public function edit(Request $request, int $id)
    {
        $pilot = new Pilot();
        $pilot = $this->getDoctrine()->getRepository(Pilot::class)->find($id);
        $form = $this->createForm(PilotFormType::class, $pilot);
        $form->add("save", SubmitType::class, array('label' => 'Save', 'attr' => array("class" => "btn btn-primary")));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('pilots');
        }

        return $this->render('pilots/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/pilot/retire", name="retireAPilot");
     */
    public function retireList()
    {
        $user = $this->getUser();
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 0, 'user' => $user));

        return $this->render('pilots/retire.html.twig', [
            "pilots" => $pilots
        ]);
    }

    /**
     * @Route("/pilot/details/{id}", name="detailsOfAPilot");
     */
    public function details(int $id)
    {
        $pilot = $this->getDoctrine()->getRepository(Pilot::class)->find($id);

        $flights = $this->getDoctrine()->getRepository(Flight::class)->findBy(array('Pilot' => $pilot));
        $timesFlown = sizeof($flights);
        if ($timesFlown > 0) {
            $lastPlane = end($flights)->getPlane();
        } else {
            $lastPlane = null;
        }

        return $this->render('pilots/details.html.twig', [
            'pilot' => $pilot,
            'timesFlown' => $timesFlown,
            "plane" => $lastPlane
        ]);
    }

    /**
     * @Route("pilot/retire/{id}", name="retireSinglePilot")
     */
    public function retire(int $id)
    {
        $pilot = $this->getDoctrine()->getRepository(Pilot::class)->find($id);
        $pilot->setRetired(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($pilot);
        $em->flush();

        return $this->redirectToRoute("pilots");
    }

}