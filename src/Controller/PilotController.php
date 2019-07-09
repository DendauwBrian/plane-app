<?php


namespace App\Controller;

use App\Entity\Pilot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PilotController extends AbstractController
{
    /**
     * @Route("/pilots", name="pilots");
     */
    public function index()
    {
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 0));

        return $this->render('pilots/index.html.twig', [
            "retired_view" => false,
            "pilots" => $pilots
        ]);
    }

    /**
     * @Route("/retired-pilots", name="retired-pilots");
     */
    public function retiredIndex()
    {
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 1));

        return $this->render('pilots/index.html.twig', [
            "retired_view" => true,
            "pilots" => $pilots
        ]);
    }

    /**
     * @Route("/create-pilot", name="create-pilot");
     * Method({"GET", "POST"})
     */
    public function create(Request $request)
    {
        $pilot = new Pilot();

        $form = $this->createFormBuilder($pilot)
            ->add("firstname", TextType::class, array('attr' => array("class" => "form-control")))
            ->add("lastname", TextType::class, array('attr' => array("class" => "form-control")))
            ->add("age", IntegerType::class, array('attr' => array("class" => "form-control", "min" => 18, "max" => 65)))
            ->add("rank", ChoiceType::class, array('choices' => array(
                "Private" => "Private",
                "Flight Engineer" => "Flight Engineer",
                "Second Officer" => "Second Officer",
                "First Officer" => "First Officer",
                "Captain" => "Captain"
            ), 'attr' => array("class" => "form-control")))
            ->add("retired", ChoiceType::class, array('choices' => array(
                "False" => false
            ), 'attr' => array("class" => "form-control", "readonly" => true)))
            ->add("save", SubmitType::class, array('label' => 'Create', 'attr' => array("class" => "btn btn-primary")))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pilot = $form->getData();

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
     * @Route("/pilot/{id}", name="single-pilot");
     */
    public function read(int $id)
    {
        return $this->render('pilots/details.html.twig', [
            'id' => $id
        ]);
    }

    /**
     * @Route("/retire-pilot", name="retire-pilot");
     */
    public function retireList()
    {
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 0));

        return $this->render('pilots/retire.html.twig', [
            "pilots" => $pilots
        ]);
    }

    /**
     * @Route("pilot/retire/{id}", name="retire-single-pilot")
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