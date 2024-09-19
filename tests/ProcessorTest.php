<?php

use PHPUnit\Framework\TestCase;

use App\Processor;
use App\BinService;
use App\BinProviderMock;
use App\RatesService;
// use App\BinProviderMock;

class ProcessorTest extends TestCase
{
	
	
	public function test_Processor_process(){
		
		define('ENV', [

		'eu_countries'=>['AT','BE','BG','CY','CZ','DE','DK','EE','ES','FI','FR','GR','HR','HU','IE','IT','LT','LU','LV','MT','NL','PO','PT','RO','SE','SI','SK']
		, 'commission_eu' => 0.01
		, 'commission_noneu' => 0.02
		, 'bin_provider' => 'App\BinProviderMock' // cached data because we hit  API's request limit... also one BIN in the example is not be resolved by the API so I need to fake a NON EU BIN to pass the tests ( with commission 0.02) ;)  
		, 'rates_provider' => 'App\RatesProviderMockLite'	// fake data -  rates reversed from the example to get the same results as in the example
		
	]); 


		$bin_provider_class  = ENV['bin_provider'];
		$rates_provider_class= ENV['rates_provider'];

		$BinService 	   = new BinService(new $bin_provider_class);	
		$RatesService      = new RatesService(new $rates_provider_class );	

		$Processor= new Processor($BinService, $RatesService, ENV );
		
		
		
	$input = '{"bin":"45717360","amount":"100.00","currency":"EUR"}
	{"bin":"516793","amount":"50.00","currency":"USD"}
	{"bin":"45417360","amount":"10000.00","currency":"JPY"}
	{"bin":"41417360","amount":"130.00","currency":"USD"}
	{"bin":"4745030","amount":"2000.00","currency":"GBP"}';
		
		 $this->expectOutputString("1\n0.47\n1.66\n2.41\n43.72\n");
		$Processor->process($input);
	}
		
}
