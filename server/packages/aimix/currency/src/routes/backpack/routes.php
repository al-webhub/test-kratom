<?php

Route::group([
    'namespace'  => '',
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
], function () { 
    $controller = config('backpack.pagemanager.admin_controller_class2', 'Aimix\Currency\app\Http\Controllers\Admin\CurrencyCrudController');
    //dd($controller);
    Route::crud('currency', $controller);
}); 