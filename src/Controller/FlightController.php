<?php


namespace App\Controller;

use App\Entity\Flight;
use App\Entity\Pilot;
use App\Entity\Plane;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FlightController extends AbstractController
{
    /**
     * @Route("/flights", name="flights");
     */
    public function index()
    {
        return $this->render('flights/index.html.twig');
    }

    /**
     * @Route("/flight/new", name="newflight");
     * Method({"GET", "POST"})
     */
    public function create(Request $request)
    {
        $flight = new Flight();

        $form = $this->createFormBuilder($flight)
            ->add('pilot', EntityType::class, array(
                'class' => Pilot::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.retired = false')
                        ->orderBy('u.rank', 'ASC');
                },
                'choice_label' => 'fullname',
                'attr' => array('class' => 'form-control')
            ))
            ->add('plane', EntityType::class, array(
                'class' => Plane::class,
                'choice_label' => 'model',
                'attr' => array('class' => 'form-control')
            ))
            ->add("save", SubmitType::class, array('label' => 'Create', 'attr' => array("class" => "btn btn-primary")))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flight = $form->getData();

            $dateTime = new \DateTime('@' . strtotime('now'));

            $flight->setFlightts($dateTime);

            $em = $this->getDoctrine()->getManager();
            $em->persist($flight);
            $em->flush();

            return $this->redirectToRoute('flights');
        }

        return $this->render("flights/create.html.twig", array(
            "form" => $form->createView()
        ));
    }

    /**
     * @Route("/flight/history", name="historyOfFlights");
     */
    public function history()
    {
        $flights = $this->getDoctrine()->getRepository(Flight::class)->findAll();

        return $this->render("flights/history.html.twig", array(
            "flights" => $flights
        ));
    }

    /**
     * @Route("/flight/detail/{id}", name="flightdetails")
     */
    public function detail(int $id)
    {
        $flight = $this->getDoctrine()->getRepository(Flight::class)->find($id);

        return $this->render("flights/details.html.twig", array(
            "flight" => $flight
        ));
    }
}