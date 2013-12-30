<?php
class ValueLookup{
	public static function getValue(/*Card*/ $card){
		$cardName = $card->name;
		$pageContent = simplexml_load_file("http://magic.tcgplayer.com/db/magic_single_card.asp?cn=".$cardName);
		$prices = $pageContent->xpath('//*[@id="StoreProducts"]/table/tbody/tr[2]/td[5]');
		
		$firstPrice;
		foreach($prices as $price)
		{
			if(!isset($firstPrice))
			echo $price;			
		}
		return $firstPrice;
	}
}