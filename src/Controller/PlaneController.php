<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlaneController extends AbstractController
{
    /**
     * @Route("/planes");
     */
    public function index()
    {
        $planes = array(
            "plane1" => "F-16"
        );

        return $this->render('planes/index.html.twig', [
            "planes" => $planes
        ]);
    }
}