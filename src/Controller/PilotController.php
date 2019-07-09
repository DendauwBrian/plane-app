<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PilotController extends AbstractController
{
    /**
     * @Route("/pilots");
     */
    public function index()
    {
        $pilots = array(
            "pilot1" => "bobby"
        );

        return $this->render('pilots/index.html.twig', [
            "pilots" => $pilots
        ]);
    }

    /**
     * @Route("/create-pilot");
     */
    public function create()
    {
        return $this->render('pilots/create.html.twig');
    }

}