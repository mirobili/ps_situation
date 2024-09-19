<?php

use PHPUnit\Framework\TestCase;

class RatesServiceTest extends TestCase
{


    public function test_RatesService_get_rate(){
		$RatesService = new App\RatesProviderMockLite ;
		// "EUR":1,
		// "GBP":0.457515,
		// "JPY":120.67,
		// "USD":1.0827
		$this->assertEquals(1,$RatesService->get_rate('EUR'));
		$this->assertEquals(0.457515,$RatesService->get_rate('GBP'));
		$this->assertEquals(120.67,$RatesService->get_rate('JPY'));
		$this->assertEquals(1.0827,$RatesService->get_rate('USD'));
	}

	
}
