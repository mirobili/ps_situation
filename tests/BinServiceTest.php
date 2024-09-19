<?php


use PHPUnit\Framework\TestCase;

use App\BinService;
use App\BinProviderMock;
// use App\BinProviderMock;

class BinServiceTest extends TestCase
{
	
	function test_get_bin(){
		
		$BinService = new App\BinService( new App\BinProviderMock );	
		$this->assertEquals(json_decode('{"number":{},"scheme":"visa","type":"debit","brand":"Visa Classic/Dankort","country":{"numeric":"208","alpha2":"DK","name":"Denmark","emoji":"🇩🇰","currency":"DKK","latitude":56,"longitude":10},"bank":{"name":"Jyske Bank A/S"}}'),
		$BinService->get_bin(45717360));
		
		
	}
	
	function test_get_bin_country_code(){
		
		$BinService = new App\BinService(new App\BinProviderMock);	
		$this->assertEquals('DK', $BinService->get_bin_country_code(45717360));
	}
	
}
