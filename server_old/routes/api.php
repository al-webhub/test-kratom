<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//middleware('auth:api')
Route::namespace('\App\Http\Controllers')->prefix('product')->group(function () {
	Route::post('/getByIds', 'Api\ProductController@getByIds');
});
