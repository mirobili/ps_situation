<?php

namespace App;

class RatesProviderMockLite implements RatesProviderInterface{
	
	private $rates;
	
	function __construct(){
 
		// Reversed from the Example 
		// USD = 1.0827
		// JPY 120.67
		// GBP = 0.457515
 
		$rates_result = '{"success":true,"timestamp":1726063924,"base":"EUR","date":"2024-09-11","rates":{
		"EUR":1,
		"GBP":0.457515,
		"JPY":120.67,
		"USD":1.0827
		}}';
		$this->rates = json_decode($rates_result, true)['rates'] ;	
	}
	
	function get_rates(){
		return $this->rates;

	}
				
	function get_rate($currency){
		return $this->rates[$currency];
	}		
}