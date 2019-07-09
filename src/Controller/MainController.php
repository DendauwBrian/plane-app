<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/");
     */
    public function index()
    {
        $test = "it works";

        return $this->render("main/index.html.twig", [
            "test" => $test
        ]);
    }

}