<?php

require_once 'lib/War.php';

session_start();

// Setup game
if (!isset($_SESSION['war']) || !$_SESSION['war'] instanceof War || isset($_GET['new'])) {
	$_SESSION['war'] = new War();
	$_SESSION['war']->shuffle(3);
	$_SESSION['war']->deal();
}

$war = $_SESSION['war'];
$message = "";
$gameOver = false;

if (isset($_POST['draw'])) {
	$response = $war->playHand();
	if ($response) {
		// See if we have a match for war
		if ($war->whoWinner == 'match') {
			$message = 'War!';
		} else {
			$message = $war->whoWinner . " won the hand!";
		}
	} else {
		if (count($war->player1->cards) == 0) {
			$message = 'Player 2 won the match!';
		} else {
			$message = 'Player 1 won the match!';
		}
		$gameOver = true;
	}
}

function getImageName($card) {
	if ($card->value == 14) {
		$value = 1;
	} elseif ($card->faceCard() != null) {
		$face = $card->faceCard();
		$value = strtolower($face[0]);
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
	<form method="post" action="index.php">
	<div style="width=100%; text-align: center; font-size: 20px;">
		<?php echo $message; ?>
	</div>
	<?php if ($gameOver) : ?>
		<a href="index.php?new=1">Play Again?</a>
	<?php else : ?>
	<div style="width=100%">
		<div style="width=48%; float: left;">
			<h2>Player 1 (<?php echo count($war->player1->cards); ?> cards)</h2>
			<img src="img/cards/b1fv.png"/>
			<?php if (isset($_POST['draw'])) : ?>
			<img src="img/cards/<?php echo getImageName($war->player1_card); ?>"/>
			<?php endif; ?>
		</div>
		<div style="width=48%; float: right;">
			<h2>Player 2 (<?php echo count($war->player2->cards); ?> cards)</h2>
			<?php if (isset($_POST['draw'])) : ?>
			<img src="img/cards/<?php echo getImageName($war->player2_card); ?>"/>
			<?php endif; ?>
			<img src="img/cards/b1fv.png"/>
		</div>
		<div style="clear: both;"/>
		<input name="draw" type="submit" value="Draw" style="margin-top: 10px;"/>
	</div>
	<?php if($war->whoWinner != 'match' and $war->whoWinner != '') :?>
	<div style="width=100%">
		<b>Cards won:</b>
		<table>
			<tr>
				<?php foreach ($war->pile as $card) :?>
				<td><img src="img/cards/<?php echo getImageName($card); ?>"/></td>
			<?php endforeach; ?>
			</tr>
		</table>
	</div>
	<?php endif; ?>
	<?php endif; ?>
	</form>
</body>