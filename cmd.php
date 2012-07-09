<?php

/*
	Command line version of the game of War.  Will play through
	one entire game of war, outputting the each play, the cards won,
	and the total number of cards each player has remaining.
*/

require "lib/Deck.php";
require "lib/Player.php";

// Initialize and shuffle deck
$deck = new Deck();
$deck->shuffle(3);

// Instantiate our players
$player1 = new Player();
$player2 = new Player();

// Deal the cards
$deck->deal($player1, $player2);

// Play war!
while (playHand($player1, $player2)) {
	echo "Player 1 has " . $player1->hasCards() . " cards\n";
	echo "Player 2 has " . $player2->hasCards() . " cards\n\n";
}

// Announce the winner!
if (!$player1->hasCards()) { print "Player 2 wins!"; }
else { print "Player 1 wins!"; }

/**
 * Controls one hand of the game
 * @param Player $player1
 * @param Player $player2
 * @param array $winnerStack
 * @return bool
*/
function playHand($player1, $player2, $winnerStack=null) 
{
	$war = false;
	$winner = null;
	if (!is_array($winnerStack)) {
		$winnerStack = array();
	}

	// Draw cards and place in the pile
	$winnerStack[] = $p1c = $player1->draw();
	$winnerStack[] = $p2c = $player2->draw();

	// Make sure both players actually had cards
	if ($p1c == false || $p2c == false) {
		return false;
	}

	// Display what was drawn
	print "Player 1 drew a " . $p1c->display() . "\n";
	print "Player 2 drew a " . $p2c->display() . "\n";

	// Compare cards and determine who won or if there is a play off
	if ($p1c->value > $p2c->value) {
		print "Player 1 wins hand\n";
		$winner = $player1;
	} elseif ($p1c->value < $p2c->value) {
		print "Player 2 wins hand\n";
		$winner = $player2;
	} elseif ($p1c->value == $p2c->value) {
		print "War!\n";
		$war = true;

		// Draw three cards from the stacks and store
		$p1Stack = $player1->drawThree();
		$p2Stack = $player2->drawThree();

		// Validate players are not out of cards
		if ($p1Stack == null || $p2Stack  == null) {
			return false;
		}

		// Place cards in pile
		$winnerStack = array_merge ($winnerStack, $p1Stack, $p2Stack);

		// Display final cards
		return playHand($player1, $player2, $winnerStack);
	}
	
	// Add the cards to the winner's stack
	$winner->push($winnerStack);
	
	// Display what cards were won
	echo "Winner wins: \n";
	foreach ($winnerStack as $card) {
		echo "\t", $card->display(), "\n";
	}

	return true;
}