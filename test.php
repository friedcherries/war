<?php

require_once 'lib/War.php';

$war = new War();
$war->shuffle(3);
$war->deal();
$war->playHand();
test($war->player1_card);

function test($card) {
	print_r($card);
}