<?php


namespace App\Controller;

use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ChatController extends AbstractController
{
    /**
     * @Route("/c/{url<^[a-zA-Z0-9_]*>}")
     * @param string $url
     * @return Response
     */
    public function chat(string $url): Response
    {

        if (!empty($url)) {


            return $this->render('chat/chat.html.twig');
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
