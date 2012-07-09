<?php

require_once 'Deck.php';
require_once 'Player.php';

/** 
 * Control class for our game of War
 */
class War extends Base {
	
	/**
	 * @var Player player one
	 */
	protected $player1;

	/**
	 * @var Card player one's current card
	 */
	protected $player1_card;

	/**
	 * @var array player one's current stack of cards
	 */
	protected $player1_stack;

	/**
	 * @var Player player two
	 */	
	protected $player2;
	
	/**
	 * @var card player two's current card
	 */
	protected $player2_card;
	
	/**
	 * @var array player two's current stack of cards
	 */
	protected $player2_stack;

	/**
	 * @var Deck the deck of cards
	 */
	protected $deck;
	
	/**
	 * @var array current cards in the pot
	 */
	protected $pile;
	
	/**
	 * @var Player reference to the winner of current hand
	 */
	protected $winner;

	/**
	 * @var whoWinner text description of who won
	 */
	protected $whoWinner;
	
	/**
	 * @var bool whether the current cards are a match
	 */
	protected $match;

	/**
	 * Default constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->player1 = new Player();
		$this->player2 = new Player();
		$this->deck = new Deck();
		$this->match = false;
	}

	/**
	 * Deals cards to players
	 */
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

 	/**
 	 * Shuffle cards through deck's shuffle function
 	 */
 	public function shuffle($times=3) {
 		$this->deck->shuffle($times);
 	}

 	/**
 	 * Reset players' cards to start new game
 	 */
 	public function newGame() {
 		$this->player1->cards = array();
 		$this->player2->cards = array();
 	}

 	/**
 	 * Plays one hand of War
 	 * @return bool returns true unless a player runs out of cards
 	 */
 	public function playHand() {
 		$this->winner = null;
 		
 		// if we have a match, draw out the extra cards
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

 		// Players draw cards and they are added to pile
 		$this->pile[] = $this->player1_card = $this->player1->draw();
 		$this->pile[] = $this->player2_card = $this->player2->draw();

 		if ($this->player1_card == false || 
 			$this->player2_card == false) {
 			return false;
 		}

 		// Determine if the cards match or if we have a winner
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
 			// If there is a winner, give them all the cards...
 			$this->winner->push($this->pile);
 		} 

 		return true;
 	}
}