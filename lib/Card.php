<?php

require_once 'Base.php';

class Card extends Base {

	protected $suit;
	protected $value;
	protected $faceCard;

	public function __construct($suit, $value) {
		parent::__construct();
		$this->suit = $suit;
		$this->value = $value;

		if ($this->value > 10) {
			$this->faceCard = true;
		} else {
			$this->faceCard = false;
		}
	}

	public function display() {
		return ($this->faceCard() == null ? $this->value : $this->faceCard()) . ' of ' . $this->suit;
	}

	public function faceCard() {
		$return = null;
		
		if ($this->faceCard) {
			switch ($this->value)
			{
				case 11: 
					$return = 'Jack';
					break;
				case 12:
					$return = 'Queen';
					break;
				case 13:
					$return = 'King';
				case 14:
					$return = 'Ace';
					break;
			}
		}

		return $return;
	}
}