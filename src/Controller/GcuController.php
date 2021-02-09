<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GcuController extends AbstractController
{
    /**
     * @Route("/GCU", name="gcu")
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('GCU.html.twig');
    }
}