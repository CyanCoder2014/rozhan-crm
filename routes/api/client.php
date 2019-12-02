<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Route::namespace('v1')->prefix('v1')->group(function () {
    Route::post('login', 'AuthController@login');

//    Route::prefix('client')->middleware(['jwt.auth'])->group(function (){
    Route::middleware(['jwt.auth'])->group(function (){
//        Route::resource('orders', 'OrderController')->except('edit','create','store','destroy');
        Route::get('orders/', 'ClientOrderController@index');
        Route::get('orders/{id}', 'ClientOrderController@show');
        Route::post('orders/{id}', 'ClientOrderController@update');
        Route::post('orders/add/step1', 'ClientOrderController@preOrder');
        Route::get('orders/add/{id}', 'ClientOrderController@serviceSchedule');
        Route::post('orders/add/{id}', 'ClientOrderController@store');
        Route::get('orders/cancel/{id}', 'ClientOrderController@cancel');
        Route::post('orders/discount', 'ClientDiscountController@ApplyDiscountToOrder');
        Route::get('order/getAvailableServices', 'ClientDiscountController@getAvailableServices');

        Route::get('profile', 'ClientUserProfileController@index');
        Route::post('profile', 'ClientUserProfileController@update');



        Route::get('contact', 'UserController@authUser');
    });


    Route::prefix('user')->group(function () {
        Route::post('/register', 'UserController@register');

//        Route::middleware(['jwt.auth', 'permission:read-profile'])->get('/profile', function (Request $request) {
        Route::get('/profile', function () {
            return Auth::user();
        });
        Route::middleware(['jwt.auth'])->post('/reset-password', 'UserController@resetPassword');
    });

    Route::middleware(['jwt.auth'])->get('/logout', 'AuthController@logout');
});


