<?php

namespace App;

class RatesProvider implements RatesProviderInterface{
	
	private $rates;
	
	function __construct(){
 
		// $API_KEY="cad28bbcf07adb5a4aa0b192f669daba";	
		$API_KEY="cad28bbcf07adb5a4aa0b192f669daba";
		$RATES_URL='https://api.exchangeratesapi.io/latest?access_key='. $API_KEY;
		$rates_result = file_get_contents($RATES_URL);

		$this->rates = json_decode($rates_result, true)['rates'] ;	
	}
	
	public function get_rates(){
		return $this->rates;
	}
				
	public function get_rate($currency){
		return $this->rates[$currency];
	}		
}
