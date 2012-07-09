<?php

require_once 'Base.php';
require_once 'Card.php';

class Deck extends Base {
	protected $cards;

	public function __construct() {
		$this->loadCards();
	}

	protected function loadCards() {
		$this->cards = array();

		foreach (array('Hearts', 'Diamonds', 'Spades', 'Clubs') as $suit) {
			for ($x=2; $x<15; $x++) {
				$this->cards[] = new Card($suit, $x);
			}
		}
	}

	public function shuffle($count) {
		for ($x=0; $x<$count; $x++) {
			shuffle($this->cards);
		}
	}

	public function deal($p1, $p2) {
		$p1Cards = array();
		$p2Cards = array();
		for ($x = 0; $x<52; $x+=2) {
			$p1Cards[] = $this->cards[$x];
		}

		for ($y = 1; $y<52; $y+=2) {
			$p2Cards[] = $this->cards[$y];
		}

		$p1->cards = $p1Cards;
		$p2->cards = $p2Cards;
 	}
}