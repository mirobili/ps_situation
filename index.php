<?php

require 'vendor/autoload.php';

use App\BinService;
use App\BinProvider;
use App\BinProviderMock;
use App\RatesService;
use App\RatesProvider;
use App\RatesProviderMock;
use App\Exception;
use App\RatesProviderMockLite;
use App\Processor;



function trace($var){
	
	print_r($var);
	echo "\n";
}

function dd($var){
	trace($var);
	exit;
}



/***********/

const ENV=[

	'eu_countries'=>['AT','BE','BG','CY','CZ','DE','DK','EE','ES','FI','FR','GR','HR','HU','IE','IT','LT','LU','LV','MT','NL','PO','PT','RO','SE','SI','SK']
	, 'commission_eu' => 0.01
	, 'commission_noneu' => 0.02
	
	//, 'bin_provider' => 'App\BinProvider' // Real public API 
	, 'bin_provider' => 'App\BinProviderMock' // cached data because we hit  API's request limit... also one BIN in the example is not be resolved by the API so I need to fake a NON EU BIN to pass the tests ( with commission 0.02) ;)  
	
	// 'rates_provider' => 'App\RatesProvider' // real LIVE data from the public API
	// 'rates_provider' => 'App\RatesProviderMock' // real data only cached
	, 'rates_provider' => 'App\RatesProviderMockLite'	// fake data -  rates reversed from the example to get the same results as in the example
	
	// you can uncomment 
]; 


$bin_provider_class  = ENV['bin_provider'];
$rates_provider_class= ENV['rates_provider'];

$BinService 	   = new BinService(new $bin_provider_class);	
$RatesService      = new RatesService(new $rates_provider_class );	

$Processor= new Processor($BinService, $RatesService, ENV );
$Processor->process(file_get_contents($argv[1]));

