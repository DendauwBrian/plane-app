<?php

namespace App\Controller;

use App\Entity\Pilot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * @Route("/training", name="training-home")
     */
    public function index()
    {
        $user = $this->getUser();
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 0, 'user' => $user));

        return $this->render('training/index.html.twig', [
            'pilots' => $pilots,
        ]);
    }
}
