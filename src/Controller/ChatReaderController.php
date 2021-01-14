<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ChatReaderController extends AbstractController
{
    /**
     * @Route("/r/{url<^[a-zA-Z0-9_]*>}")
     * @param string $url
     * @return Response
     */
    public function chat(string $url): Response
    {

        if (!empty($url)) {

            return $this->render('chat/chatReader.html.twig');
        } else {
            return $this->redirectToRoute('home');
        }
    }
}
