<?php

namespace App;


class BinService{
	function __construct(private $BinProvider){
		// $this->BinProvider = $BinProvider;
	}
	
	function get_bin($bin){
		try{
		 return $this->BinProvider->get_bin($bin);
		} catch(Exception $e){
			throw $e; 
		}
	}
	
	function get_bin_country_code($bin){
		
		try{
			$bin_data = $this->get_bin($bin);

			// dd($bin_data);
		
			 return $bin_data->country->alpha2?? null;
			// return $this->BinProvider->get_bin_country_code($bin);
		} catch(Exception $e){
			throw $e; 
		}	
	}
}