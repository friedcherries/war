<?php

/*
	Command line version of the game of War.  Will play through
	one entire game of war, outputting the each play, the cards won,
	and the total number of cards each player has remaining.
*/

require "lib/War.php";
$war = new War();
$war->shuffle(5);
$war->deal();

while ($war->playHand()) {
	echo "Player 1 drew a " . $war->player1_card->display() . "\n";
	echo "Player 2 drew a " . $war->player2_card->display() . "\n";
	if ($war->whoWinner == 'match') {
		echo "Matching cards!\n";	
	} else {
		echo $war->whoWinner . " wins following cards:\n";

		foreach ($war->pile as $card) {
			echo "\t", $card->display(), "\n";
		}

	}
	echo "Player 1 has " . count($war->player1->cards) . " cards\n";
	echo "Player 2 has " . count($war->player2->cards) . " cards\n";
	echo "================\n\n";
}


if (!$war->player1->hasCards()) { print "Player 2 wins!\n\n"; }
else { print "Player 1 wins!\n\n"; }
