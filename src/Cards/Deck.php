<?php

namespace App\Cards;

use App\Cards\Card;

class Deck
{
    public $deck = [];

    public function __construct($fill = true)
    {
        if ($fill) {
            for ($x = 0; $x <= 3; $x++) {
                for ($i = 1; $i <= 13; $i++) {
                    $this->add_card($i, $x);
                }
            }
        }
    }

    public function add_card($value, $suit)
    {
        $this->deck[] = new Card($value, $suit);
    }
}
