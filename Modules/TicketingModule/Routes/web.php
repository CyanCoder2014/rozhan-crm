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
include ('admin.php');
Route::prefix('ticketing')->middleware('auth')->group(function() {
    Route::get('/', 'TicketController@index')->name('ticketingmodule.ticket.index');
    Route::post('/', 'TicketController@store')->name('ticketingmodule.ticket.store');
    Route::get('/{ticket}/show', 'TicketController@show')->name('ticketingmodule.ticket.show');
    Route::post('/{ticket}/reply', 'TicketController@reply')->name('ticketingmodule.ticket.reply');
    Route::get('/{ticket}/delete', 'TicketController@destroy')->name('ticketingmodule.ticket.delete');
    Route::get('/find/user', 'TicketController@findUser')->name('ticketingmodule.user.find');

});
Route::prefix('ticketingmodule')->group(function() {

});
