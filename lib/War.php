<?php

require_once 'Deck.php';
require_once 'Player.php';

class War extends Base {
	protected $player1;
	protected $player1_card;
	protected $player1_stack;
	protected $player2;
	protected $player2_card;
	protected $player2_stack;
	protected $deck;
	protected $pile;
	protected $winner;
	protected $whoWinner;
	protected $match;

	public function __construct() {
		parent::__construct();
		$this->player1 = new Player();
		$this->player2 = new Player();
		$this->deck = new Deck();
		$this->match = false;
	}

	public function deal() {
		$p1Cards = array();
		$p2Cards = array();
		
		for ($x = 0; $x<52; $x+=2) {
			$p1Cards[] = $this->deck->cards[$x];
		}

		for ($y = 1; $y<52; $y+=2) {
			$p2Cards[] = $this->deck->cards[$y];
		}

		$this->player1->cards = $p1Cards;
		$this->player2->cards = $p2Cards;
 	}	

 	public function shuffle($times=3) {
 		$this->deck->shuffle($times);
 	}

 	public function newGame() {
 		$this->player1->cards = array();
 		$this->player2->cards = array();
 	}

 	public function playHand() {
 		$this->winner = null;
 		
 		if ($this->match == true) {
 			$this->player1_stack = $this->player1->drawThree();
 			$this->player2_stack = $this->player2->drawThree();
 			
 			if ($this->player1_stack == false || $this->player2_stack == false) {
 				return false;
 			}

 			$this->pile = array_merge($this->pile, $this->player1_stack, $this->player2_stack);
	 		$this->match = false;
 		} else {
 			$this->pile = array();
 		}

 		$this->pile[] = $this->player1_card = $this->player1->draw();
 		$this->pile[] = $this->player2_card = $this->player2->draw();

 		if ($this->player1_card == false || 
 			$this->player2_card == false) {
 			return false;
 		}

 		if ($this->player1_card->value == $this->player2_card->value) {
 			$this->match = true;
 			$this->whoWinner = 'match';
 		} else { 
 			if ($this->player1_card->value > $this->player2_card->value) {
 				$this->winner = $this->player1;
 				$this->whoWinner = 'Player 1';
 			} elseif ($this->player1_card->value < $this->player2_card->value) {
 				$this->winner = $this->player2;
 				$this->whoWinner = 'Player 2';
 			}
 			$this->winner->push($this->pile);
 		} 

 		return true;
 	}

 	public function getStatus() {

 	}
}