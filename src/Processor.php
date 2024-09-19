<?php


namespace App;

class Processor{
	
	function __construct( private $BinService, private $RatesService, private $ENV ){
		
	}
	
	private function get_env($key){
		return $this->ENV[$key]?? null;	
	}

	private function isEu($c) {
		return in_array($c, $this->get_env('eu_countries')) ;
	}

	private function to_euro($amount, $currency){

		$rate = $this->RatesService->get_rate($currency);
		if($rate==0){
			throw new Exception("rate for $currency is 0");
		}
		return $amount / $rate;
	}

	private function get_commission($country_code){

		return $this->isEu($country_code) ? $this->get_env('commission_eu') : $this->get_env('commission_noneu') ;
	}

	/**********************************/

	function ceil_float($value, $places=0){
		$tmp = pow(10,$places);
		return ceil( $value*$tmp ) / $tmp ;
	}

	function trace($var){
		
		print_r($var);
		echo "\n";
	}

	function dd($var){
		$this->trace($var);
		exit;
	}

	/********************************/

	public function process($input){

		foreach (explode("\n", $input) as $row) {

			$row = trim($row);		  
			if (empty($row)) continue;

			try{
				$tt = json_decode($row);
				$country_code = $this->BinService->get_bin_country_code($tt->bin);
				$euro_amount = $this->to_euro($tt->amount, $tt->currency);
				$commission = $this->get_commission($country_code);
			 	$commission_amount= $euro_amount* $commission;
				echo $this->ceil_float($commission_amount, 2);
				echo "\n";

			}catch(Exception $e){

				// here we could skip the transaction and raise a ticket to application support
			}
		}
	}
}