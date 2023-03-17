<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/product-translate', function(){
	$products = \App\Models\Product::all();
	
	foreach($products as $product){
		$name = $product->name;
		$description = $product->description;
		$extras = $product->extras;
		
		
		$product->name = json_encode([
			'en' => $name,
			'ru' => $name
		]);
		$product->description = json_encode([
			'en' => $description,
			'ru' => $description
		]);
		$product->extras = [
			'en' => $extras,
			'ru' => $extras
		];
		
		$product->save();
	}
});
*/

/*
Route::get('/faq-translate', function(){
	$faqs = \App\Models\Faq::all();
	
	foreach($faqs as $faq){
		$title = $faq->title;
		$content = $faq->content;
		
		
		$faq->title = json_encode([
			'en' => $title,
			'ru' => $title
		]);
		$faq->content = json_encode([
			'en' => $content,
			'ru' => $content
		]);
		
		$faq->save();
	}
});
*/

/*
Route::get('/test', 'HomeController@img');

Route::get('/phpinfo', function(){
	phpinfo();
});
*/
// GLIDE FOR

Route::get('/optimize', 'ImageController@optimize');
Route::get('/glide/{path}', 'ImageController@show')->where('path', '.*')->middleware('optimizeImages');

Route::redirect('/home', '/', 301);
Route::redirect('/login', '/');
Route::redirect('/blog', '/guidebook', 301);
Route::redirect('/kratom', '/shop', 301);
Route::redirect('/sumatra', '/shop', 301);
Route::redirect('/kratom/akuamma-powder', '/akuamma-powder', 301);
Route::redirect('/kratom/red-kratom/borneo-red', '/borneo-red', 301);
Route::redirect('/kratom/borneo-red', '/borneo-red', 301);
Route::redirect('/kratom/kratom-malay-green', '/kratom-malay-green', 301);
Route::redirect('/kratom/red-kratom/maeng-da-red', '/maeng-da-red', 301);
Route::redirect('/kratom/maeng-da-red', '/maeng-da-red', 301);
Route::redirect('/kratom/white-kratom/maeng-da-white', '/maeng-da-white', 301);
Route::redirect('/kratom/red-kratom/kratom-borneo-white', '/shop', 301);
Route::redirect('/kratom/Green-Vein-Thai-Kratom', '/Green-Vein-Thai-Kratom', 301);
Route::redirect('/kratom/maeng-da-white', '/maeng-da-white', 301);
Route::redirect('/kratommaeng-da-white', '/maeng-da-white', 301);
Route::redirect('/kratom/maeng-da-green', '/maeng-da-green', 301);
Route::redirect('/kratom/green-kratom/maeng-da-green', '/maeng-da-green', 301);


Route::redirect('/index.php/maeng-da-green', '/maeng-da-green', 301);
Route::redirect('/index.php/rewards', '/rewards', 301);
Route::redirect('/index.php/reviews', '/reviews', 301);
Route::redirect('/index.php', '/', 301);
Route::redirect('/index.php/borneo-red', '/borneo-red', 301);


// AUTH ROUTES
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');
	
// POST
Route::post('/cart/update', '\Aimix\Shop\app\Http\Controllers\CheckoutController@update');

$optionalLanguageRoutes = function() {
	Route::get('/', 'HomeController@index')->name('home');
	
	Route::prefix('account')->middleware(['CheckIfGuest'])->group(function () {
	  Route::redirect('/', '/account/order-history')->name('account');
	  Route::view('/newsletter', 'account.newsletter')->name('newsletter');
	  Route::view('/edit-account', 'account.edit')->name('edit-account');
	  Route::view('/change-password', 'account.change-password')->name('change-password');
	  Route::view('/addresess', 'account.addresess')->name('addresess');
	  Route::get('/order-history', 'HomeController@orderHistory')->name('order-history');
	  Route::get('/referral-network', '\Aimix\Account\app\Http\Controllers\AccountController@transactions')->name('transactions');
	  Route::post('/transactions', '\Aimix\Account\app\Http\Controllers\AccountController@transactions')->name('makeRequest');
	  Route::post('/changePassword', '\Aimix\Account\app\Http\Controllers\AccountController@changePassword')->name('changePassword');
	  Route::post('/edit', '\Aimix\Account\app\Http\Controllers\AccountController@edit')->name('accountEdit');
	  Route::post('/addresess', '\Aimix\Account\app\Http\Controllers\AccountController@addresess')->name('accountAddresess');
	});
	
	$products = App\Models\Product::active()->get();
	foreach($products as $product){
		Route::get($product->slug, '\App\Http\Controllers\CatalogController@show')->name('product_page');
	}
	
	Route::prefix('/shop')->group(function() {
	    Route::get('/{category_slug?}', '\App\Http\Controllers\CatalogController@index')->name('shop');
	    Route::get('/seen/{id}', 'HomeController@shopSeen');
	});
	
	Route::post('/catalog', '\App\Http\Controllers\CatalogController@index')->name('makeRequest');
	Route::post('/catalog/calcRequest', '\App\Http\Controllers\CatalogController@calcRequest')->name('calcRequest');
	Route::post('/catalog/requestSearchList/{type}/{value}', '\Aimix\Shop\app\Http\Controllers\CatalogController@requestSearchList')->name('requestSearchList');
	
	Route::prefix('/cart')->group(function() {
	  Route::get('/', '\Aimix\Shop\app\Http\Controllers\CheckoutController@cart')->middleware(['CheckIfCartEmpty'])->name('cart');
	});
	
	Route::get('/checkout', '\Aimix\Shop\app\Http\Controllers\CheckoutController@checkout')->middleware(['CheckIfCartEmpty'])->name('checkout');
	
	Route::get('/order/{id}/clone', '\Aimix\Shop\app\Http\Controllers\Admin\OrderCrudController@cloneOrder');
	Route::post('/order/create', '\Aimix\Shop\app\Http\Controllers\Admin\OrderCrudController@create');
	
	Route::prefix('/reviews')->group(function() {
	    Route::post('/like/{id}', '\App\Http\Controllers\ReviewController@like');
	    Route::post('/review/add', '\App\Http\Controllers\ReviewController@add');
	    Route::post('/reply/create', '\App\Http\Controllers\ReviewController@reply');
	    Route::post('/loadmore', '\App\Http\Controllers\ReviewController@loadmore');
	    
	    Route::get('/{type?}', '\App\Http\Controllers\ReviewController@index');
	    
	    Route::post('/{type?}', '\App\Http\Controllers\ReviewController@index');
	    Route::post('/create/{type?}', '\App\Http\Controllers\ReviewController@create');
	    Route::post('/requestSearchList/{value}', '\App\Http\Controllers\ReviewController@requestSearchList')->name('requestSearchList');
	    
	  });
	
	Route::prefix('/guidebook')->group(function() {
	  Route::any('/', '\App\Http\Controllers\NewsController@index')->name('guidebook');
	  Route::get('/{article?}', '\App\Http\Controllers\NewsController@show')->name('article');
	});
	
	Route::get('/faq', 'HomeController@faq')->name('faq');
	Route::post('/feedback/create/{type}', '\Aimix\Feedback\app\Http\Controllers\Admin\FeedbackCrudController@create');
	
	Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
	Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
	
	Route::view('/contacts', 'pages.contacts')->name('contacts');
	Route::view('our-advantages', 'pages.advantages')->name('advantages');
	
	Route::post('/attribute/update', '\App\Http\Controllers\CatalogController@changeAttr');
	Route::post('/transaction/create', '\Aimix\Account\app\Http\Controllers\AccountController@createTransaction');

	Route::get('/sitemap.xml', '\App\Http\Controllers\HomeController@getSitemap');
	
	/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
	Route::get('{page}/{subs?}', ['uses' => '\App\Http\Controllers\PageController@index'])
	    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);

};


Auth::routes();
	
// LOCALIZATED ROUTES
$langs_array = array_keys(array_diff_key(config('backpack.crud.locales'), config('backpack.crud.executed_locales')));
$langs_array = array_map(function($lang){
	if($lang != 'en_US')
		return  strtolower(str_replace('_', '-', $lang));
},$langs_array);
$langs_array = array_filter($langs_array);
$languages = implode('|', $langs_array);

//dd($langs_array);
Route::group(['prefix' => '{locale}', 'where' => ['locale' => $languages], 'middleware' => ['lcl']], $optionalLanguageRoutes);

Route::group(['middleware' => ['lcl-remove']], $optionalLanguageRoutes);
