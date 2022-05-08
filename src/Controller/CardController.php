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
    public function card(SessionInterface $session ): Response
    {
        $deck  = $session->get("deck") ?? 0;
        if (gettype($deck) == "integer") {
            $session->set("deck", new Deck());
        }

        return $this->render('card/card.html.twig', ['deck' => $deck->deck]);
    }

    /**
     * @Route("card/api/deck", name="card-api", methods={"GET"})
     */
    public function cardAPI(SessionInterface $session): Response
    {
        $deck  = $session->get("deck") ?? 0;
        if (gettype($deck) == "integer") {
            $session->set("deck", new Deck());
        }

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

    //  ____________________________
    /**
     * @Route("/card/deck", name="card-deck", methods={"GET", "HEAD"})
     */
    public function cardDeck(): Response
    {
        return $this->render('card/card.html.twig');
    }

    /**
     * @Route("/card/deck/shuffle", name="card-shuffle", methods={"GET", "HEAD"})
     */
    public function cardShuffle(): Response
    {
        return $this->render('card/card.html.twig');
    }

    /**
     * @Route("/card/deck/draw", name="card-draw", methods={"GET", "HEAD"})
     */
    public function cardDraw(): Response
    {
        return $this->render('card/card.html.twig');
    }

    /**
     * @Route("/card/deck/draw/{number}", name="card-draw-number", methods={"GET", "HEAD"})
     */
    public function cardDrawNumber(): Response
    {
        return $this->render('card/card.html.twig');
    }

    /**
     * @Route("/card/deck/deal/{players}/{cards}", name="card-deal-players-cards", methods={"GET", "HEAD"})
     */
    public function cardDealPlayers(): Response
    {
        return $this->render('card/card.html.twig');
    }

    /**
     * @Route("/card/deck2", name="card-deck2", methods={"GET", "HEAD"})
     */
    public function cardDeck2(): Response
    {
        return $this->render('card/card.html.twig');
    }
}
