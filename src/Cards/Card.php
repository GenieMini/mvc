<?php

namespace App\Cards;

class Card
{
    public $value;
    public $suit;
    
    // Methods
    public function __construct($value, $suit)
    {
        $this->value = $value;
        $this->suit = $suit;
    }

    public function get_value() {
        return $this->value;
    }
    public function get_suit() {
        return $this->suit;
    }
}

