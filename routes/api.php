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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('v1')->middleware(['jwt.auth'])->get('test', 'HomeController@test');
Route::namespace('API\Client\v1')->prefix('v1')->group(function () {
    Route::post('login', 'AuthController@login');

    Route::prefix('user')->group(function () {
        Route::post('/register', 'UserController@register');

        Route::middleware(['jwt.auth', 'permission:read-profile'])->get('/profile', function (Request $request) {
            return $request->user();
        });

        Route::middleware(['jwt.auth'])->post('/reset-password', 'UserController@resetPassword');
    });

    Route::middleware(['jwt.auth'])->get('/logout', 'AuthController@logout');
});


Route::middleware(['jwt.auth'])->post('/test', 'HomeController@test');




Route::middleware(['jwt.auth'])->resource('companies', 'CompaniesController')->except('edit','create');

Route::middleware(['jwt.auth'])->resource('contacts', 'ContactController')->except('edit','create');

Route::middleware(['jwt.auth'])->resource('serviceCategories', 'ServiceCategoryController')->except('edit','create');
Route::middleware(['jwt.auth'])->resource('services', 'ServiceController')->except('edit','create');
Route::middleware(['jwt.auth'])->resource('persons', 'PersonController')->except('edit','create');



Route::middleware(['jwt.auth'])->resource('orders', 'OrderController')->except('edit','create','store');


Route::middleware(['jwt.auth'])->post('orders/add/step1', 'OrderController@preOrder');


Route::middleware(['jwt.auth'])->get('orders/add/{id}', 'OrderController@serviceSchedule')->name('order.step2');
Route::middleware(['jwt.auth'])->post('orders/add/{id}', 'OrderController@store')->name('order.store');
Route::middleware(['jwt.auth'])->resource('person/{person_id}/timing', 'PersonTimingController')->except('edit','create');
Route::middleware(['jwt.auth'])->resource('person/{person_id}/service', 'PersonTimingController')->except('edit','create');
Route::middleware(['jwt.auth'])->get('person/{person_id}/services', 'PersonServicesController@index');
Route::middleware(['jwt.auth'])->post('person/{person_id}/services', 'PersonServicesController@update');
Route::middleware(['jwt.auth'])->post('contact/notify', 'ContactNotifyController@send');
Route::middleware(['jwt.auth'])->post('addOrder', 'OrderController@addOrder');
Route::middleware(['jwt.auth'])->post('editOrder', 'OrderController@editOrder');
Route::middleware(['jwt.auth'])->post('payPayment', 'OrderController@payPayment');
Route::middleware(['jwt.auth'])->post('printPayment', 'OrderController@printPayment');
Route::middleware(['jwt.auth'])->get('/report', 'ReportController@report1');
Route::middleware(['jwt.auth'])->get('/UserReport', 'ReportController@UserReport');
