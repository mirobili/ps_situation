<?php

namespace App;
use Exception;

use function PHPUnit\Framework\throwException;
class BinProvider{

	// function get_bin_country_code($bin):string{
		// $binResults = file_get_contents('https://lookup.binlist.net/' .$bin);
		// if (!$binResults)
			// throwException('Binresults Empty'); //die('error!');
		// $r = json_decode($binResults);
		// return $r->country->alpha2 ?? throw new Exception('COUNTRY CODE not found');
	// }
	
	function get_bin($bin){
			
			$url= 'https://lookup.binlist.net/' .$bin;
			//$binResults = file_get_contents($url);
			
			if (($data = @file_get_contents($url)) === false) {
				  $error = error_get_last();
				  echo "HTTP request failed. Error was: " . $error['message'];
				  return json_decode('{"number":null,"country":{},"bank":{}}');
			} else {
				 return $r = json_decode($data);
				  echo "Everything went better than expected";
			}
			
			
			// if (!$binResults)
				// throw new Exception('Bin results Empty'); //die('error!');
				// dd($binResults);	
				// $r = json_decode($binResults);
			// }catch(Exception $e){
				// throw new Exception($e->getMessage());
			// }
	}
}
