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
    public function card(SessionInterface $session): Response
    {
        $deck  = $session->get("deck") ?? [];
        if (gettype($deck) == "array") {
            $deck = new Deck();
            $session->set("deck", $deck);
        }

        $data = [
            'deck' => $deck->deck,
            'message' => "This page creates a deck for you!\nand puts it in session"
        ];

        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("card/api/deck", name="card-api", methods={"GET"})
     */
    public function cardAPI(SessionInterface $session): Response
    {
        $deck  = $session->get("deck") ?? [];
        if (gettype($deck) == "array") {
            $deck = new Deck();
            $session->set("deck", $deck);
        }

        return new JsonResponse($deck->deck);
    }

    //  ____________________________
    /**
     * @Route("/card/deck", name="card-deck", methods={"GET", "HEAD"})
     */
    public function cardDeck(SessionInterface $session): Response
    {
        $deck   = $session->get("deck") ?? [];
        $cards  = [];
        $values = [];
        $suits  = [];
        if (gettype($deck) == "object") {
            for ($i = 0; $i < count($deck->deck); $i++) {
                $values[] = $deck->deck[$i]->value;
                $suits[] = $deck->deck[$i]->suit;
            }

            array_multisort($suits, $values);
            $sorted = new Deck(false);

            for ($i = 0; $i < count($deck->deck); $i++) {
                $sorted->add_card($values[$i], $suits[$i]);
            }

            $cards = $sorted->deck;
        }

        $data = [
            'deck' => $cards,
            'message' => "Heres the sorted deck"
        ];

        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="card-shuffle", methods={"GET", "HEAD"})
     */
    public function cardShuffle(SessionInterface $session): Response
    {
        $deck = new Deck();
        shuffle($deck->deck);
        $session->set("deck", $deck);

        $cards = $deck->deck;

        $data = [
            'deck' => $cards,
            'message' => "We shuffled the deck!"
        ];

        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw", name="card-draw", methods={"GET", "HEAD"})
     */
    public function cardDraw(SessionInterface $session): Response
    {
        $deck  = $session->get("deck") ?? [];
        $cards  = [];
        if (gettype($deck) == "object") {
            if ($deck->deck != []) {
                $cards[] = array_pop($deck->deck);
            }
        }

        if ($deck->deck == []) {
            $message = "deck is empty!";
        } else {
            $message = "We drew a card from the deck!";
        }

        $data = [
            'deck' => $cards,
            'message' => $message
        ];

        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw/{number}", name="card-draw-number", methods={"GET", "HEAD"})
     */
    public function cardDrawNumber(SessionInterface $session, int $number): Response
    {
        $deck  = $session->get("deck") ?? [];
        $cards  = [];
        if (gettype($deck) == "object") {
            if (count($deck->deck) < $number) {
                $message = "not enough cards to draw $number";
            } else {
                $message = "we drew $number cards";
                for ($i = 0; $i < $number; $i++) {
                    $cards[] = array_pop($deck->deck);
                }
            }
        }

        $data = [
            'deck' => $cards,
            'message' => $message
        ];

        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck/deal/{players}/{cards}", name="card-deal-players-cards", methods={"GET", "HEAD"})
     */
    public function cardDealPlayers(SessionInterface $session, int $players, int $cards): Response
    {
        $deck  = $session->get("deck") ?? [];
        $deal  = [];
        if (gettype($deck) == "object") {
            if (count($deck->deck) < ($cards * $players)) {
                $message = "not enough cards to draw for everyone";
                $data = [
                    'message' => $message,
                ];
            } else {
                for ($i = 0; $i < $players; $i++) {
                    $message = "we drew $cards cards to $players players";
                    $temp = [];
                    for ($j = 0; $j < $cards; $j++) {
                        $temp[] = array_pop($deck->deck);
                    }
                    $deal[] = $temp;
                }
                $data = [
                    'message' => $message,
                    'deal' => $deal
                ];
            }
        }



        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck2", name="card-deck2", methods={"GET", "HEAD"})
     */
    public function cardDeck2(SessionInterface $session): Response
    {
        $deck  = new Deck();
        $deck->add_card("black", "joker");
        $deck->add_card("red", "joker");

        $data = [
            'deck' => $deck->deck,
            'message' => "Deck with joker"
        ];

        return $this->render('card/card.html.twig', $data);
    }
}
