<?php

require_once 'Base.php';

/**
 * Card class for our game of War
 */
class Card extends Base {

	/**
	 * @var string suit of the card
	 */
	protected $suit;

	/**
	 * @var int numeric value of the card
	 */
	protected $value;

	/**
	 * @var bool whether card is a face card
	 */
	protected $faceCard;

	/**
	 * default constructor
	 */
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

	/**
	 * Returns a printable version of the card
	 * @return string 
	 */
	public function display() {
		return ($this->faceCard() == null ? $this->value : $this->faceCard()) . ' of ' . $this->suit;
	}

	/**
	 * Returns the type of face card
	 * @return string
	 */
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
					break;
				case 14:
					$return = 'Ace';
					break;
			}
		}

		return $return;
	}
}