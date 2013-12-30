<?php
require_once "services/ValueLookup.php";
class Card {
	protected $name;
	protected $value;
	protected $set;
	protected $colors;
	protected $qty;

	public function __construct( $inName, $inQty = 1, $inValue = 0, $inSet="", /*array*/$inColors=array()){
		if( isset( $inName ))
		{
			$this->name = $inName;
		}
		else
		{
			throw new Exception('No name set, name is required!');
		}
		$this->qty = $inQty;
		$this->value = $inValue;
		$this->set = $inSet;
		$this->colors = $inColors;
	}
	public function getName()
	{
		return $this->name;
	}

	public function calculateValue()
	{
		$this->value = ValueLookup::getValue($this);
	}
	public function getQty()
	{
		return $this->qty;
	}
	public function getValue()
	{
		return $this->value;
	}
}