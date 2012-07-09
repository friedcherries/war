<?php

require_once 'Base.php';
require_once 'Card.php';

/**
 * Deck of cards
 */
class Deck extends Base {
	
	/**
	 * @var array array of cards
	 */
	protected $cards;

	/**
	 * Default constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->loadCards();
	}

	/**
	 * Creates the initial deck of cards
	 */
	protected function loadCards() {
		$this->cards = array();

		foreach (array('Hearts', 'Diamonds', 'Spades', 'Clubs') as $suit) {
			for ($x=2; $x<15; $x++) {
				$this->cards[] = new Card($suit, $x);
			}
		}
	}

	/**
	 * Simulates shuffling of the deck of cards
	 * @param int how many times to shuffle the deck
	 */
	public function shuffle($count) {
		for ($x=0; $x<$count; $x++) {
			shuffle($this->cards);
		}
	}
}