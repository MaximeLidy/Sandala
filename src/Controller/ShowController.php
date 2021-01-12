<?php


namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ShowController extends AbstractController
{
    /**
     * @Route("/m/{url<^[a-zA-Z0-9_]*>}", name="program_list")
     * @param string $url
     * @return Response
     */
    public function show(string $url): Response
    {

        if (!empty($url)) {
            $messageRepo = $this->getDoctrine()->getRepository(Message::class)->findOneBy(['url' => $url]);
            if($messageRepo != null){
                $type = $messageRepo->getType();
                $message = $messageRepo->getText();
                switch ($type) {
                    case "letter":
                        return $this->render('show/letter.html.twig', ['message' => $message]);
                    case "note":
                        return $this->render('show/note.html.twig', ['message' => $message]);
                    case "code":
                        return $this->render('show/code.html.twig', ['message' => $message]);
                }
            } else {
                return $this->redirectToRoute('home');
            }
        } else {
            return $this->redirectToRoute('home');
        }


    }
}