<?php


namespace App\Controller;

use App\Entity\Plane;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlaneController extends AbstractController
{
    /**
     * @Route("/planes", name="planes");
     */
    public function index()
    {
        $planes = $this->getDoctrine()->getRepository(Plane::class)->findAll();

        return $this->render('planes/index.html.twig', [
            "planes" => $planes
        ]);
    }

    /**
     * @Route("/create-plane", name="create-plane");
     */
    public function create(Request $request)
    {
        $plane = new Plane();

        $form = $this->createFormBuilder($plane)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plane = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($plane);
            $em->flush();

            return $this->redirectToRoute('planes');
        }

        return $this->render('planes/create.html.twig', [
            "form" => $form->createView()
        ]);
    }
}