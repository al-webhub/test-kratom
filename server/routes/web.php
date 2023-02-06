<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MigrateDbController;

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

Route::get('/migr', [MigrateDbController::class, 'all']);

Route::get('/mailable', function () {
  // $order = App\Models\Override\Order::find(24);
  // return new App\Mail\OrderCreatedAdmin($order);

  // $order = App\Models\Override\Order::find(24);
  // return new App\Mail\OrderCreated($order);

  // $user = App\Models\Override\Profile::find(24);
  // return new App\Mail\UserRegistered($user);

  // $user = App\Models\Override\Profile::find(24);
  // return new App\Mail\ReferralRegistered($user);

  // $transaction = Backpack\Transactions\app\Models\Transaction::find(963);
  // return new App\Mail\WithdrawalCompleted($transaction);

  // $transaction = Backpack\Transactions\app\Models\Transaction::find(963);
  // return new App\Mail\ReferralBonus($transaction);

  // $transaction = Backpack\Transactions\app\Models\Transaction::find(963);
  // return new App\Mail\CashbackBonus($transaction);

  // $transaction = Backpack\Transactions\app\Models\Transaction::find(963);
  // return new App\Mail\ReviewBonus($transaction);
});


Route::prefix('auth')->group(function() {
	Route::middleware('web')->post('/{provider}', 'App\Http\Controllers\Auth\OAuthController@redirect')->where('provider', 'google|facebook');
	Route::post('/{provider}/callback', 'App\Http\Controllers\Auth\OAuthController@callback')->where('provider', 'google|facebook');
	Route::middleware('auth:profile')->get('/getUser', 'App\Http\Controllers\Auth\OAuthController@getUser');
});

//Route::post('/login', [LoginController::class, 'login']);