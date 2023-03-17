<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\GuidebookController;


use Backpack\Profile\app\Http\Controllers\Api\ProfileController;

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


Route::controller(ProductController::class)->group(function () {
  Route::post('/products/{id}/updateQualities', 'updateQualities');
  Route::post('/products/similar', 'similar')->middleware('api');
});

Route::controller(GuidebookController::class)->group(function () {
  Route::get('/guidebook', 'index');
  Route::get('/guidebook/{slug}', 'show');
});


