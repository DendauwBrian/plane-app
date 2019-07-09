<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function create(Request $request)
    {
        return $this->render("flights/create.html.twig");
    }

    /**
     * @Route("/flight/history", name="historyOfFlights");
     */
    public function history()
    {
        return $this->render("flights/history.html.twig");
    }
}