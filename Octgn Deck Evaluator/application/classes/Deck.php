<?php
class Deck {
	protected $name;
	protected $cards;
	protected $calculated = false;
	public function __construct(/*string*/ $name)
	{
		if( isset($name))
		{
			$this->name = $name;
		}
		else
		{
			throw new Exception("name not set, name is required");
		}

	}
	
	public function addCard( /*Card*/ $card )
	{
		if( isset($this->cards) ){
			$this->cards[count($this->cards)] = $card;
		}else{
			$this->cards=array(0=>$card);
		}
		$this->calculated = false;
	}
	
	public function getCards()
	{
		if(isset($this->cards)){
			if(!$this->calculated){
				foreach ($this->cards as /*Card*/ $card){
					$card->calculateValue();
				}
				$this->calculated = true;
			}
			$cardsCopy = $this->cards;
			return $cardsCopy;
		}
	}
	public function getName()
	{
		return $this->name;
	}
}