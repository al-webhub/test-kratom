<?php
	function url_locale($url){
		return url(Session::get('url_lang') . '/' . ltrim($url, '/'));
	}
	
	function get_hreflands(){
		$languages = array_diff_key(config('backpack.crud.locales'), config('backpack.crud.executed_locales'));
		
		$href_array = [];
		
		foreach($languages as $key => $language) {
			$iso = strtolower(str_replace('_', '-', $key));
	    	
	    	if(strpos(\Request::url(), '/'.Session::get('lang')))
	    		$url = str_replace('/'.Session::get('lang'), '/'.$iso, \Request::url());
	    	else
	    		$url = rtrim('/'. $iso . '/' . \Request::path(), '/');
	    	
	    	if($key == 'en_US')
	    		$url = str_replace('/'.Session::get('lang'), '', \Request::url());
	    		
	    	$href_array[$iso] = $url;
    	}

		return $href_array;
	}
	
/*
	function check_url($url){
		
		try{
			$client = new \GuzzleHttp\Client();
			$response = $client->request('GET', $url);
			$code = $response->getStatusCode();
			dd($code);
		}catch(\Exception $e){
			$code = 301;	
		}
		
		return  ($code >= 200 && $code <= 300)? true: false;
	}
*/