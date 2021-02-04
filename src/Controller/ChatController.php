<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Port;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


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
     * @Route("/r/{port<^[0-9]*>}", name = "reader")
     * @param string $port
     * @return Response
     */
    public function reader(string $port): Response
    {

        if (isset($port) && $port != "") {
            $number = $this->getDoctrine()->getRepository(Port::class)->findPortIfUnavailable($port);

            if ($number != null) {
                return $this->render('chat/chatReader.html.twig', ["portNumber" => $port]);
            } else {
                return $this->render('chat/chatError.html.twig');
            }
        }
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }

    /**
     * @Route("/w", name = "writer")
     * @return Response
     */
    public function writer(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        
        // A remplacer par findbyPortAvailable
        $port = $this->getDoctrine()->getRepository(Port::class)->find(1);
        $port->setAvailable(true);
        $entityManager->persist($port);
        $entityManager->flush();

        $url = $this->generateUrl('reader', ["port" => $port->getNumber()], UrlGeneratorInterface::ABSOLUTE_URL);

        if (isset($port)) {
            $port->setAvailable(false);
            $entityManager->persist($port);
            $entityManager->flush();
            return $this->render('chat/chatWriter.html.twig', ["portNumber" => $port->getNumber(), "readerUrl" =>$url]);
        } else {
            return $this->render('chat/chatError.html.twig');
        }
    }
}
