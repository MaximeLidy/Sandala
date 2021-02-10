<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Port;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;



class ChatController extends AbstractController
{
    /**
     * @Route("/a/w", name="welcome")
     *
     * @return Response
     */
    public function welcome(): Response
    {

        return $this->render('chat/chatWelcome.html.twig');
    }

    /**
     * @Route("/chat/server/run", name="run")
     *
     * @param KernelInterface $kernel
     * @return Response
     * @throws \Exception
     */
    public function chatServerRun(KernelInterface $kernel): Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput(array(
            'command' => 'run:websocket-server'
        ));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
    }

    /**
     * @Route("/chat/server/stop", name="stop")
     *
     * @param KernelInterface $kernel
     * @return Response
     * @throws \Exception
     */
    public function chatServerStop(KernelInterface $kernel): Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput(array(
            'command' => 'stop:websocket-server'
        ));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        // return new Response(""), if you used NullOutput()
        return new Response($content);
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
