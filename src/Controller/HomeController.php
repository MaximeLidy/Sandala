<?php


namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageSubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * The controller for the category add form
     *
     * @Route("/", name="home")
     */
    public function new(Request $request) : Response
    {
        // Create a new Category Object
        $message = new Message();
        // Create the associated Form
        $form = $this->createForm(MessageSubmitType::class, $message);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Deal with the submitted data
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($message);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('home');
        }
        // Render the form
        return $this->render('home.html.twig', [
            "form" => $form->createView(),
        ]);
    }

}