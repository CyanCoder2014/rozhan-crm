<?php
use Illuminate\Http\Request;


Route::namespace('v1')->prefix('v1')->group(function () {
    Route::post('login', 'AuthController@login');

//    Route::prefix('client')->middleware(['jwt.auth'])->group(function (){
    Route::prefix('client')->group(function (){
//        Route::resource('orders', 'OrderController')->except('edit','create','store','destroy');
        Route::get('orders/', 'OrderController@index');
        Route::get('orders/{id}', 'OrderController@show');
        Route::post('orders/{id}', 'OrderController@update');
        Route::post('orders/add/step1', 'OrderController@preOrder');
        Route::post('orders/add/{id}', 'OrderController@store');
        Route::get('orders/cancel/{id}', 'OrderController@cancel');
    });


    Route::prefix('user')->group(function () {
        Route::post('/register', 'UserController@register');

        Route::middleware(['jwt.auth', 'permission:read-profile'])->get('/profile', function (Request $request) {
            return $request->user();
        });
        Route::middleware(['jwt.auth'])->post('/reset-password', 'UserController@resetPassword');
    });

    Route::middleware(['jwt.auth'])->get('/logout', 'AuthController@logout');
});


