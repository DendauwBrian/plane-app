<?php


namespace App\Controller;

use App\Entity\Plane;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
     * @Route("/create-plane", name="create-plane");
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

            $dateTime = new \DateTime('@'.strtotime('now'));

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
}