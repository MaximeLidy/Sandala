<?php


namespace App\Controller;

use App\Entity\Message;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ShowController extends AbstractController
{
    /**
     * @Route("/m/{url<^[a-zA-Z0-9_]*>}", name="message")
     * @param string $url
     * @return Response
     */
    public function show(string $url): Response
    {
        //If url is set in BDD : display
        if (!empty($url)) {
            $messageRepo = $this->getDoctrine()->getRepository(Message::class)->findOneBy(['url' => $url]);

            if($messageRepo != null){
                //Check if message has expired
                $messageExpiration = $messageRepo->getDeathDate();
                $now = new DateTime("now");
                //If so, delete it
                if($now > $messageExpiration){
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($messageRepo);
                    $entityManager->flush();
                    return $this->render('show/removed.html.twig', ['message' => "This message has expired"]);
                } else {
                    //Else, display it
                    $type = $messageRepo->getType();
                    $message = $messageRepo->getText();
                    switch ($type) {
                        case "letter":
                            return $this->render('show/letter.html.twig', [
                                'message' => $message,
                                'type' => 'You\'ve got a letter!'
                            ]);
                        case "note":
                            return $this->render('show/note.html.twig', [
                                'message' => $message,
                                'type' => 'You\'ve got a note!'
                            ]);
                        case "code":
                            return $this->render('show/code.html.twig', [
                                'message' => $message,
                                'type' => 'Some has shared code with you!'
                            ]);
                        default:
                            return $this->redirectToRoute('home');
                    }
                }

            } else {
                return $this->redirectToRoute('home');
            }
        } else {
            return $this->redirectToRoute('home');
        }
    }
}