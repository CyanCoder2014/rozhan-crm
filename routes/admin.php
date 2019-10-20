<?php
Route::middleware('admin')->prefix('admin')->group(function (){
   Route::namespace('Admin')->group(function (){
       Route::get('/','IndexController@index')->name('admin.index');
   });
});