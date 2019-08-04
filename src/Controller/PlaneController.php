<?php


namespace App\Controller;

use App\Entity\Flight;
use App\Entity\Plane;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlaneController extends AbstractController
{
    /**
     * @Route("/planes", name="planes");
     */
    public function index()
    {
        $planes = $this->getDoctrine()->getRepository(Plane::class)->findAll();

        return $this->render('planes/index.html.twig', [
            "planes" => $planes
        ]);
    }

    /**
     * @Route("/plane/new", name="newPlane");
     */
    public function create(Request $request)
    {
        $plane = new Plane();

        $form = $this->createFormBuilder($plane)
            ->add("model", TextType::class, array('attr' => array('class' => 'form-control')))
            ->add("manufacturer", TextType::class, array('attr' => array("class" => "form-control")))
            ->add("engines", ChoiceType::class, array('choices' => array(
                "Wankel" => "Wankel",
                "Diesel" => "Diesel",
                "Jet" => "Jet",
                "Electric" => "Electric"
            ), 'attr' => array("class" => "form-control")))
            ->add("save", SubmitType::class, array('label' => 'Create', 'attr' => array("class" => "btn btn-primary")))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plane = $form->getData();

            $dateTime = new \DateTime('@' . strtotime('now'));

            $plane->setBuildDay($dateTime);

            $em = $this->getDoctrine()->getManager();
            $em->persist($plane);
            $em->flush();

            return $this->redirectToRoute('planes');
        }

        return $this->render('planes/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/plane/details/{id}", name="detailsOfAPlane")
     */
    public function detail(int $id)
    {
        $plane = $this->getDoctrine()->getRepository(Plane::class)->find($id);
        // TODO get from DB
        $flights = $this->getDoctrine()->getRepository(Flight::class)->findBy(array('Plane' => $plane));
        $timesFlown = sizeof($flights);
        if ($timesFlown) {
            $lastPilot = end($flights)->getPilot();
        } else {
            $lastPilot = null;
        }

        return $this->render('planes/details.html.twig', [
            'pilot' => $lastPilot,
            'timesFlown' => $timesFlown,
            "plane" => $plane
        ]);
    }

    /**
     * @Route("/plane/decommission/{id}", name="decommissionPlane")
     */
    public function decommission(int $id)
    {
        $plane = $this->getDoctrine()->getRepository(Plane::class)->find($id);
        $plane->setDecommissioned(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($plane);
        $em->flush();

        return $this->redirectToRoute('planes');
    }

    /**
     * @Route("/plane/edit/{id}", name="editPlane");
     */
    public function edit(Request $request, int $id)
    {
        $plane = new Plane();
        $plane = $this->getDoctrine()->getRepository(Plane::class)->find($id);

        $form = $this->createFormBuilder($plane)
            ->add("model", TextType::class, array('attr' => array('class' => 'form-control')))
            ->add("manufacturer", TextType::class, array('attr' => array("class" => "form-control")))
            ->add("engines", ChoiceType::class, array('choices' => array(
                "Wankel" => "Wankel",
                "Diesel" => "Diesel",
                "Jet" => "Jet",
                "Electric" => "Electric"
            ), 'attr' => array("class" => "form-control")))
            ->add("save", SubmitType::class, array('label' => 'Save', 'attr' => array("class" => "btn btn-primary")))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('planes');
        }

        return $this->render('planes/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }
}