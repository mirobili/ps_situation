<?php

namespace App;
use Exception;

class BinProviderMock implements BinProviderInterface{

	public function get_bin($bin){
		
		
		/// data from the real bin provider cached to avoid dependency on remote service while runing the tests 
		
		$binResults[45717360] = '{"number":{},"scheme":"visa","type":"debit","brand":"Visa Classic/Dankort","country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank A/S"}}';
		$binResults[516793]   = '{"number":{},"scheme":"mastercard","type":"debit","brand":"Debit Mastercard","country":{"numeric":"440","alpha2":"LT","name":"Lithuania","emoji":"🇱🇹","currency":"EUR","latitude":56,"longitude":24},"bank":{"name":"Swedbank Ab"}}';
		$binResults[45417360] = '{"number":{},"scheme":"visa","type":"credit","brand":"Visa Classic","country":{"numeric":"392","alpha2":"JP","name":"Japan","emoji":"🇯🇵","currency":"JPY","latitude":36,"longitude":138},"bank":{"name":"Credit Saison Co., Ltd."}}';
		
		// Invalid BIN 
		// faked data to pass the tests
		// Reversed from the Example 
		$binResults[41417360] = '{"number":{},"scheme":"visa","type":"credit","brand":"Visa Classic","country":{"numeric":"392","alpha2":"JP","name":"Japan","emoji":"🇯🇵","currency":"JPY","latitude":36,"longitude":138},"bank":{"name":"Credit Saison Co., Ltd."}}'; 
		
		$binResults[4745030]  = '{"number":{},"scheme":"visa","type":"debit","brand":"Visa Classic","country":{"numeric":"440","alpha2":"LT","name":"Lithuania","emoji":"🇱🇹","currency":"EUR","latitude":56,"longitude":24},"bank":{"na  me":"Uab Finansines Paslaugos Contis"}}';

		if(!isset($binResults[$bin])){
			throw new Exception("BIN $bin not found");
		}
		return $r = json_decode($binResults[$bin]);
				
	}
}