<?php
class ValueLookup{
	public static function getValue(/*Card*/ $card){
		$cardName = $card->getName();
		$cardPriceUrl = "http://magic.tcgplayer.com/db/magic_single_card.asp?cn=".$cardName;
		$cardPriceUrl = str_replace(" ","%20", $cardPriceUrl);
		$curlhandle = curl_init($cardPriceUrl);
		curl_setopt($curlhandle, CURLOPT_RETURNTRANSFER, 1);
		$pageContent = curl_exec($curlhandle);
		curl_close($curlhandle);
		
		preg_match_all( '/036;">\$([\d,\.]+)<\/TD>/',$pageContent,$prices);
		$firstPrice;
		foreach($prices[1] as $price)
		{
			if(!isset($firstPrice)){
				$firstPrice = str_replace(",","",$price);
			}		
		}
		if(!isset($firstPrice)){
			return "Undefined*";
		}
		return $firstPrice;
	}
}