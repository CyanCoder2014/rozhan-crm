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
//Auth::routes();

//include('admin.php');
//Route::get('/province/{id}/cities', 'ProvinceController@getcities')->name('province.cities');
//Route::get('/city/find', 'CityController@find')->name('city.find');


//Route::get('/', function () {
//    return 'empty Project';
//});


Route::get('/', 'HomeController@index')->name('index');
//Route::get('testing',function (){
//   return \App\Person::first()->availableTime('2019-11-24');
//});
//Route::get('/request', 'HomeController@request')->name('request');
//Route::get('/payment', 'HomeController@payment')->name('payment');
//
//Route::get('/client', 'HomeController@client')->name('client');
//Route::get('/clientAdd', 'HomeController@clientAdd')->name('clientAdd');
//Route::get('/clientSelect', 'HomeController@clientSelect')->name('clientSelect');
//Route::get('/profile', 'HomeController@profile')->name('profile');
//
//Route::get('/report', 'HomeController@report')->name('report');




Route::get('/{catchall?}', 'HomeController@index');
Route::get('/{any}', 'HomeController@index')->where('any', '(.*)');

//Route::get('/{route?}', 'HomeController@index')->where('route', '([0-9]+(\/){0,1})*');
