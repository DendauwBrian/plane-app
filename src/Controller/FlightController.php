<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}