<?php

namespace App\Cards;

class Card
{
    public $value; // 1-13
    public $suit;  // 0-3  : spades, hearts, clubs, diamond

    // Methods
    public function __construct($value, $suit)
    {
        $this->value = $value;
        $this->suit = $suit;
    }

    /* public function get_value() {
        return $this->value;
    }
    public function get_suit() {
        return $this->suit;
    } */
}
