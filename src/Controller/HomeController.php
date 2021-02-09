<?php


namespace App\Controller;

use App\Entity\Stats;
use App\Service\CounterService;
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
    public function new(Request $request): Response
    {
        //Loading em
        $entityManager = $this->getDoctrine()->getManager();

        $counterObject = $this->getDoctrine()
            ->getRepository(Stats::class)
            ->find(1);

        if (!is_null($counterObject)) {
            $counter = $counterObject->getCounter();
        } else {
            $counter = 0;
        }

        $now = $this->getNowTime();

        new CleanMessagesService($entityManager, $now);


        $message = new Message();

        $form = $this->createForm(MessageSubmitType::class, $message);


        if ($request->isMethod('POST')) {

            if ($request->request->get($form->getName())["text"] != null) {
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

                    //Feed the stats
                    $type = $message->getType();
                    new CounterService($entityManager, $type);

                    // Flush the persisted object
                    $entityManager->flush();
                    // Finally redirect to categories list
                    $request->setMethod("GET");
                    return $this->render('home.html.twig', [
                        "counter" => $counter,
                        "url" => $url
                    ]);
                }
            }
        }

        // Render the form
        return $this->render('home.html.twig', [
            "counter" => $counter,
            "form" => $form->createView(),
        ]);
    }

    public function addInterval($interval)
    {
        $dt = $this->getNowTime();
        $dt->add(new DateInterval($interval));
        return $dt;
    }

    public function getNowTime()
    {
        return new DateTime('NOW');
    }

}