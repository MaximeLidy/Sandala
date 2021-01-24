<?php


namespace App\Controller;

use DateInterval;
use DateTime;
use App\Entity\Message;
use App\Form\MessageSubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UrlGeneratorService;
use App\Service\CleanMessagesService;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HomeController extends AbstractController
{

    /**
     * The controller for the category add form
     *
     * @Route("/", name="home")
     */
    public function new(Request $request) : Response
    {
        //Loading em
        $entityManager = $this->getDoctrine()->getManager();

        $now = $this->getNowTime();
        new CleanMessagesService($entityManager, $now);

        // Create a new Category Object
        $message = new Message();
        // Create the associated Form
        $form = $this->createForm(MessageSubmitType::class, $message);


        if($request->isMethod('POST')){

            //$dt = $request->request->get($form->getName())["deathDate"];

            if($request->request->get($form->getName())["text"] != null){
                $dt = $request->request->get($form->getName())['duration'];

                $dt = $this->addInterval($dt);

                $form->submit($request->request->get($form->getName()));

                // Was the form submitted ?
                if ($form->isSubmitted() && $form->isValid()) {

                    //Recording deathTimer
                    $message->setDeathDate($dt);

                    $urlGeneratorService = new UrlGeneratorService($entityManager);
                    $uniqUrl = $urlGeneratorService->getUrl();
                    $message->setUrl($uniqUrl);

                    $url = $this->generateUrl('message', array('url' => $uniqUrl), UrlGeneratorInterface::ABSOLUTE_URL);

                    // Persist Category Object
                    $entityManager->persist($message);
                    // Flush the persisted object
                    $entityManager->flush();
                    // Finally redirect to categories list
                    $request->setMethod("GET");
                    return $this->render('home.html.twig', [
                        "url" => $url
                    ]);
                }
            }
        }

        // Render the form
        return $this->render('home.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    public function addInterval($interval){
        $dt = $this->getNowTime();
        $dt->add(new DateInterval($interval));
        return $dt;
    }

    public function getNowTime(){
        return new DateTime('NOW');
    }

}