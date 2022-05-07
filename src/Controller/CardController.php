<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Cards\Deck;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card", methods={"GET", "HEAD"})
     */
    public function card(): Response
    {
        return $this->render('');
    }

    /**
     * @Route("card/api/deck", name="card-api", methods={"GET"})
     */
    public function cardAPI(): Response
    {
        $deck = new Deck();

        /* $data = [
            'message' => 'Welcome to the lucky number API',
            'deck' => $deck->deck
        ]; */
        
        return new JsonResponse($deck->deck);
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
