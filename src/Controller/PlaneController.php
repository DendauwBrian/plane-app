<?php


namespace App\Controller;

use App\Entity\Plane;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlaneController extends AbstractController
{
    /**
     * @Route("/planes");
     */
    public function index()
    {
        $planes = $this->getDoctrine()->getRepository(Plane::class)->findAll();

        return $this->render('planes/index.html.twig', [
            "planes" => $planes
        ]);
    }

    
}