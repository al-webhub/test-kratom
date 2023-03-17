@php
	if(Route::currentRouteName() == 'article'){
		$request_url = route('guidebook');
		$request_path = 'guidebook';
	}else{
		$request_url = Request::url();
		$request_path = Request::path();
	}	
@endphp
<ul class="footer__lang_list">
    @foreach($languages as $key => $language)
    @php
    	$iso = strtolower(str_replace('_', '-', $key));
    	$lang = strtok($language, ' ');
    	$is_country = preg_match("/\(([^\]]*)\)/", $language, $county_matches);
    	$country = $is_country? $county_matches[1]: null;
    	$current_language = $iso == Session::get('lang')? $lang: $current_language;
    	
    	if(strpos(Request::url(), '/'.Session::get('lang')))
    		$url = str_replace('/'.Session::get('lang'), '/'.$iso, $request_url);
    	else
    		$url = rtrim('/'. $iso . '/' . $request_path, '/');
    	
    	
    	if($key == 'en_US')
    		$url = str_replace('/'.Session::get('lang'), '', $request_url);
    		
    	
    @endphp
    <li class="{{ Session::get('lang') == $iso? 'selected': '' }}">
    	<a href="{{ $url }}">
            <img class="footer__lang_flag" src="{{ url('/img/flags/'.config('lang.flags.'.$key)) }}">
            <span class="footer__lang_language">{{ $lang}}</span>
            <span class="footer__lang_country">{{ $country }}</span>
    	</a>
    </li>
    @endforeach
</ul>