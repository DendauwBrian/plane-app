<?php

namespace App\Controller;

use App\Entity\Pilot;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * @Route("/training", name="training")
     */
    public function index()
    {
        $user = $this->getUser();
        $pilots = $this->getDoctrine()->getRepository(Pilot::class)->findBy(array('retired' => 0, 'user' => $user));

        return $this->render('training/index.html.twig', [
            'pilots' => $pilots,
        ]);
    }

    /**
     * @Route("/training/train/{id}", name="trainAPilot")
     */
    public function train($id)
    {
        return $this->render('training/train.html.twig', [
            'pilot' => $id,
        ]);

    }
}
