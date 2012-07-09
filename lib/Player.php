<?php

require_once 'Base.php';

class Player extends Base {
	protected $cards;

	public function draw() {
		if ($this->hasCards()) {
			return array_pop($this->cards);
		} else {
			return false;
		}
	}

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

	public function push($cards) {
		if (!is_array($cards)) {
			$cards = array($cards);
		}
		$this->cards = array_merge($cards, $this->cards);
	}

	public function hasCards() {
		return count($this->cards);
	}
}