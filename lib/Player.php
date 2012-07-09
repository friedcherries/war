<?php

require_once 'Base.php';

/**
 * Represents a Player for our game of War
 */
class Player extends Base {
	
	/**
	 * @var array players array of cards
	 */
	protected $cards;

	/**
	 * Pops a card of the stack and returns it.
	 * @return Card
	 */
	public function draw() {
		if ($this->hasCards()) {
			return array_pop($this->cards);
		} else {
			return false;
		}
	}

	/**
	 * Removes three cards from stack and returns as an array
	 * @return array
	 */
	public function drawThree() {
		$stack = array();
		
		for ($x=0; $x<3; $x++) {
			$card = $this->draw();
			if ($card !== false) {
				$stack[] = $card;
			} else {
				return false;
			}
		}

		return $stack;
	}

	/**
	 * Adds cards to the bottom of the stack
	 * @param mixed cards to add to stack
	 */
	public function push($cards) {
		if (!is_array($cards)) {
			$cards = array($cards);
		}
		$this->cards = array_merge($cards, $this->cards);
	}

	/**
	 * Returns number of cards player currently has in stack
	 * @return int
	 */
	public function hasCards() {
		return count($this->cards);
	}
}