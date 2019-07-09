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
        $pilot = array(
            "id" => 1,
            "firstname" => "bobby",
            "lastname" => "bobson",
            "rank" => "Private"
        );
        $pilot2 = array(
            "id" => 2,
            "firstname" => "billy",
            "lastname" => "billson",
            "rank" => "Private"
        );

        $pilots = array(
            "pilot1" => $pilot,
            "pilot2" => $pilot2
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

    /**
     * @Route("/pilot/{id}");
     */
    public function read(int $id)
    {
        return $this->render('pilots/details.html.twig', [
            'id' => $id
        ]);
    }

}