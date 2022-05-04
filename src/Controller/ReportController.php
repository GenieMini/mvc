<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    // kmom 2 __________________________
    /**
     * @Route("/card", name="card", methods={"GET", "HEAD"})
     */
    public function card(): Response
    {
        return $this->render('');
    }

    /**
     * @Route("/card", name="card-process", methods={"POST"})
     */
    public function cardProcess(
        Request $request,
        SessionInterface $session 
    ): Response {
        $var  = $request->request->get('var');

        $val  = $session->get("sum") ?? 0;

        // $session->set("sum", $val);

        $this->addFlash("info", "You are bababooey, $var");

        return $this->redirectToRoute('card');
    }
}
