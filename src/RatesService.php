<?php

namespace App;


class RatesService{
	
	private $rates;
	
	function __construct( private $RatesProvider){
		 
	}
	
	function get_rate($currency){
		$rates = $this->get_rates();
		return $rates[$currency];
	}
	
	function get_rates(){
		if(!isset($this->rates)){
			$this->rates = $this->RatesProvider->get_rates();
		}
		return $this->rates;
		// return $this->RatesProvider->get_rates();
	}
}
