<?php
require_once 'classes/Deck.php';
require_once 'classes/Card.php';
if($_FILES["file"]["error"]>0)
{
	echo "Unable to process file:".$_FILES["file"]["error"];
}
else
{
	/*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	echo "Type: " . $_FILES["file"]["type"] . "<br>";
	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
	$deckFile = simplexml_load_file($_FILES["file"]["tmp_name"]);
	$mainCardNames = $deckFile->xpath("//section[@name='Main']/card");
	$mainCardQtys = $deckFile->xpath("//section[@name='Main']/card/@qty");
	$sideboardCardNames = $deckFile->xpath("//section[@name='Sideboard']/card");
	$sideboardCardQtys = $deckFile->xpath("//section[@name='Sideboard']/card/@qty");
	
	$deck = new Deck($_FILES["file"]["name"]);
	foreach ($mainCardNames as $index=> $name){
		$qty = $mainCardQtys[$index];
		$deck->addCard(new Card($name, $qty ));
	}
	foreach($sideboardCardNames as $index=>$name){
		$qty = $sideboardCardQtys[$index];
		$deck->addCard(new Card($name, $qty ));
	}
	echo $deck->getName()."<ul>";
	
	$cards = $deck->getCards();
	foreach($cards as $card){
		echo "<li>".$card->getName()." x".$card->getQty()."@".$card->getValue()."</li>";
	}
	echo "</ul>";
}