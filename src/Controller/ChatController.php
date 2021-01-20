<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Port;


class ChatController extends AbstractController
{
    /**
     * @Route("/a/accueil", name="accueil")
     * 
     * @return Response
     */
    public function accueil(): Response
    {
        return $this->render('chat/chatAccueil.html.twig');
    }


    /**
     * @Route("/r/{url<^[a-zA-Z0-9_]*>}", name = "reader")
     * @return Response
     */
    public function reader(): Response
    {
        return $this->render('chat/chatReader.html.twig');
    }

    /**
     * @Route("/w/{url<^[a-zA-Z0-9_]*>}", name = "writer")
     * @return Response
     */
    public function writer(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $port = $this->getDoctrine()->getRepository(Port::class)->find(1);
        $port->setAvailable(true);
        $entityManager->persist($port);
        $entityManager->flush();


        if (isset($port)) {
            $port->setAvailable(false);
            $entityManager->persist($port);
            $entityManager->flush();
            return $this->render('chat/chatWriter.html.twig', ["portNumber" => $port->getNumber()]);
        } else {
            return $this->render('chat/chatError.html.twig');
        }
    }
}