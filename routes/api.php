

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
    return $request->user()->allPermissions();
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




Route::middleware(['jwt.auth'])->get('getCurrentUser', 'UserController@getCurrentUser');
Route::middleware(['jwt.auth'])->get('headerInbox', 'ContactNotifyController@headerInbox');


Route::middleware(['jwt.auth'])->resource('companies', 'CompaniesController')->except('edit','create')->middleware([
    'index' => 'permission:companies.index',
    'store' => 'permission:companies.store',
    'update' => 'permission:companies.edit',
    'show' => 'permission:companies.show',
    'destroy' => 'permission:companies.destroy',
]);
Route::middleware(['jwt.auth'])->resource('contacts', 'ContactController')->except('edit','create')->middleware([
    'index' => 'permission:contacts.index',
    'store' => 'permission:contacts.store',
    'update' => 'permission:contacts.edit',
    'show' => 'permission:contacts.show',
    'destroy' => 'permission:contacts.destroy',
]);

Route::middleware(['jwt.auth'])->resource('productCategories', 'ProductCategoryController')->except('edit','create')->middleware([
    'index' => 'permission:product.categories.index',
    'store' => 'permission:product.categories.store',
    'update' => 'permission:product.categories.edit',
    'show' => 'permission:product.categories.show',
    'destroy' => 'permission:product.categories.destroy',
]);
Route::middleware(['jwt.auth'])->resource('products', 'ProductController')->except('edit','create')->middleware([
    'index' => 'permission:products.index',
    'store' => 'permission:products.store',
    'update' => 'permission:products.edit',
    'show' => 'permission:products.show',
    'destroy' => 'permission:products.destroy',
]);

Route::middleware(['jwt.auth'])->resource('serviceCategories', 'ServiceCategoryController')->except('edit','create')->middleware([
    'index' => 'permission:service.categories.index',
    'store' => 'permission:service.categories.store',
    'update' => 'permission:service.categories.edit',
    'show' => 'permission:service.categories.show',
    'destroy' => 'permission:service.categories.destroy',
]);
Route::middleware(['jwt.auth'])->resource('services', 'ServiceController')->except('edit','create')->middleware([
    'index' => 'permission:services.index',
    'store' => 'permission:services.store',
    'update' => 'permission:services.edit',
    'show' => 'permission:services.show',
    'destroy' => 'permission:services.destroy',
]);
Route::middleware(['jwt.auth'])->resource('persons', 'PersonController')->except('edit','create')->middleware([
    'index' => 'permission:persons.index',
    'store' => 'permission:persons.store',
    'update' => 'permission:persons.edit',
    'show' => 'permission:persons.show',
    'destroy' => 'permission:persons.destroy',
]);



Route::middleware(['jwt.auth'])->resource('orders', 'OrderController')->except('edit','create','store')->middleware([
    'index' => 'permission:orders.index',
    'update' => 'permission:orders.edit',
    'show' => 'permission:orders.show',
    'destroy' => 'permission:orders.destroy',
]);
Route::middleware(['jwt.auth'])->post('orders/add/step1', 'OrderController@preOrder')->middleware('permission:orders.store');
Route::middleware(['jwt.auth'])->post('orders/add/quick', 'OrderController@addOrderQuick')->middleware('permission:orders.quickstore');
Route::middleware(['jwt.auth'])->get('orders/add/{id}', 'OrderController@serviceSchedule')->name('order.step2')->middleware('permission:orders.store');
Route::middleware(['jwt.auth'])->post('orders/add/{id}', 'OrderController@store')->name('order.store')->middleware('permission:orders.store');

Route::middleware(['jwt.auth'])->resource('person/{person_id}/timing', 'PersonTimingController')->except('edit','create')->middleware([
    'index' => 'permission:persons.timing.index',
    'store' => 'permission:persons.timing.store',
    'update' => 'permission:persons.timing.edit',
    'show' => 'permission:persons.timing.show',
    'destroy' => 'permission:persons.timing.destroy',
]);
Route::middleware(['jwt.auth'])->resource('person/{person_id}/service', 'PersonServicesController')->except('edit','create')->middleware([
    'index' => 'permission:persons.service.index',
    'store' => 'permission:persons.service.store',
    'update' => 'permission:persons.service.edit',
    'show' => 'permission:persons.service.show',
    'destroy' => 'permission:persons.service.destroy',
]);
//Route::middleware(['jwt.auth'])->get('person/{person_id}/services', 'PersonServicesController@index');
//Route::middleware(['jwt.auth'])->post('person/{person_id}/services', 'PersonServicesController@update');

Route::middleware(['jwt.auth'])->post('contact/notify', 'ContactNotifyController@send')->middleware('permission:contacts.notify');

//Route::middleware(['jwt.auth'])->post('addOrder', 'OrderController@addOrder');
//Route::middleware(['jwt.auth'])->post('editOrder', 'OrderController@editOrder');
//Route::middleware(['jwt.auth'])->post('payPayment', 'OrderController@payPayment');
//Route::middleware(['jwt.auth'])->post('printPayment', 'OrderController@printPayment');

Route::middleware(['jwt.auth'])->get('/report', 'ReportController@report1')->middleware('permission:report');
Route::middleware(['jwt.auth'])->get('/baseReport', 'ReportController@baseReport')->middleware('permission:baseReport');
Route::middleware(['jwt.auth'])->get('/UserReport', 'ReportController@UserReport')->middleware('permission:UserReport');
Route::middleware(['jwt.auth'])->get('/workCalendar', 'workCalendarController@index')->middleware('permission:workCalendar');

Route::namespace('Payment')->prefix('payment')->group(function () {
    Route::middleware(['jwt.auth'])->resource('/CompanyPayment', 'CompanyPaymentController')->except('edit','create')->middleware([
        'index' => 'permission:company.payment.index',
        'store' => 'permission:company.payment.store',
        'update' => 'permission:company.payment.edit',
        'show' => 'permission:company.payment.show',
        'destroy' => 'permission:company.payment.destroy',
    ]);
    Route::middleware(['jwt.auth'])->resource('/CustomerPayment', 'CustomerPaymentController')->except('edit','create')->middleware([
        'index' => 'permission:customer.payment.index',
        'store' => 'permission:customer.payment.store',
        'update' => 'permission:customer.payment.edit',
        'show' => 'permission:customer.payment.show',
        'destroy' => 'permission:customer.payment.destroy',
    ]);
    Route::middleware(['jwt.auth'])->resource('/BuyFactor', 'BuyFactorController')->except('edit','create')->middleware([
        'index' => 'permission:buyfactor.index',
        'store' => 'permission:buyfactor.store',
        'update' => 'permission:buyfactor.edit',
        'show' => 'permission:buyfactor.show',
        'destroy' => 'permission:buyfactor.destroy',
    ]);
    Route::middleware(['jwt.auth'])->resource('/Account', 'AccountController')->except('edit','create')->middleware([
        'index' => 'permission:account.index',
        'store' => 'permission:account.store',
        'update' => 'permission:account.edit',
        'show' => 'permission:account.show',
        'destroy' => 'permission:account.destroy',
    ]);
});