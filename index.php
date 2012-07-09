<?php

require_once 'lib/Deck.php';
require_once 'lib/Player.php';

// Setup game
if (!isset($_SESSION['deck'])) {
	$_SESSION['deck'] = new Deck();
	$_SESSION['deck']->shuffle(3);
	$_SESSION['player1'] = new Player();
	$_SESSION['player2'] = new Player();
	$_SESSION['deck']->deal($_SESSION['player1'], $_SESSION['player2']);
}

if (isset($_POST['draw'])) {
	$pc1 = $_SESSION['player1']->draw();
	$pc2 = $_SESSION['player2']->draw();
}

function getImageName($card) {
	if ($card->value == 14) {
		$value = 1;
	} else {
		$value = $card->value;
	}

	$suit = strtolower($card->suit[0]);

	return "${suit}${value}.png";
}
?>

<html>
<head>
	<title>War!</title>
</head>
<body>
	<form method="post">
	<div style="width=100%">
		<div style="width=48%; float: left;">
			<h2>Player 1</h2>
			<img src="img/cards/b1fv.png"/>
			<img src="img/cards/<?php echo getImageName($pc1); ?>"/>
		</div>
		<div style="width=48%; float: right;">
			<h2>Player 2</h2>
			<img src="img/cards/<?php echo getImageName($pc2); ?>"/>
			<img src="img/cards/b1fv.png"/>
		</div>
		<div style="clear: both;"/>
		<input name="draw" type="submit" value="Draw" style="margin-top: 10px;"/>
	</div>
	</form>
</body>