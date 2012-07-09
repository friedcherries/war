<?php

require_once 'Base.php';
require_once 'Card.php';

class Deck extends Base {
	protected $cards;

	public function __construct() {
		parent::__construct();
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
}