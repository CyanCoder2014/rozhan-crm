

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


Route::middleware(['jwt.auth'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/{id}', 'UserController@show');
    });


    Route::post('/test', 'HomeController@test');
    Route::get('/sms/info', 'SmsController@info');
    Route::get('/sms', 'SmsController@index');




    Route::get('getCurrentUser', 'UserController@getCurrentUser');
    Route::get('headerInbox', 'ContactNotifyController@headerInbox');


    Route::resource('companies', 'CompaniesController')->except('edit','create')->middleware([
        'index' => 'permission:companies.index',
        'store' => 'permission:companies.store',
        'update' => 'permission:companies.edit',
        'show' => 'permission:companies.show',
        'destroy' => 'permission:companies.destroy',
    ]);
    Route::resource('contacts', 'ContactController')->except('edit','create')->middleware([
        'index' => 'permission:contacts.index',
        'store' => 'permission:contacts.store',
        'update' => 'permission:contacts.edit',
        'show' => 'permission:contacts.show',
        'destroy' => 'permission:contacts.destroy',
    ]);

    Route::resource('contactProfiles', 'ProfileController')->except('edit','create')->middleware([
        'index' => 'permission:contacts.index',
        'store' => 'permission:contacts.store',
        'update' => 'permission:contacts.edit',
        'show' => 'permission:contacts.show',
        'destroy' => 'permission:contacts.destroy',
    ]);


    Route::get('contactslist','ContactController@list');
    Route::get('contact/{id}/usedDiscounts','ContactController@UsedDiscount');

    Route::post('contactAdd/importExcel', 'ContactController@import')->middleware('permission:contacts.store');


    Route::resource('productCategories', 'ProductCategoryController')->except('edit','create')->middleware([
        'index' => 'permission:product.categories.index',
        'store' => 'permission:product.categories.store',
        'update' => 'permission:product.categories.edit',
        'show' => 'permission:product.categories.show',
        'destroy' => 'permission:product.categories.destroy',
    ]);
    Route::resource('products', 'ProductController')->except('edit','create')->middleware([
        'index' => 'permission:products.index',
        'store' => 'permission:products.store',
        'update' => 'permission:products.edit',
        'show' => 'permission:products.show',
        'destroy' => 'permission:products.destroy',
    ]);

    Route::resource('serviceCategories', 'ServiceCategoryController')->except('edit','create')->middleware([
        'index' => 'permission:service.categories.index',
        'store' => 'permission:service.categories.store',
        'update' => 'permission:service.categories.edit',
        'show' => 'permission:service.categories.show',
        'destroy' => 'permission:service.categories.destroy',
    ]);
    Route::resource('services', 'ServiceController')->except('edit','create')->middleware([
        'index' => 'permission:services.index',
        'store' => 'permission:services.store',
        'update' => 'permission:services.edit',
        'show' => 'permission:services.show',
        'destroy' => 'permission:services.destroy',
    ]);
    Route::resource('persons', 'PersonController')->except('edit','create')->middleware([
        'index' => 'permission:persons.index',
        'store' => 'permission:persons.store',
        'update' => 'permission:persons.edit',
        'show' => 'permission:persons.show',
        'destroy' => 'permission:persons.destroy',
    ]);



    Route::resource('orders', 'OrderController')->except('edit','create','store')->middleware([
        'index' => 'permission:orders.index',
        'update' => 'permission:orders.edit',
        'show' => 'permission:orders.show',
        'destroy' => 'permission:orders.destroy',
    ]);

    Route::get('orderPayment/personsOrderServices/{id}', 'OrderController@personsOrderServices')->middleware('permission:orders.show');
    Route::get('personOrder/getOrderServicesForPerson/{id}', 'OrderController@getOrderServicesForPerson')->middleware('permission:workCalendar');


    Route::get('order/getAvailableServices', 'OrderController@getAvailableServices');

    Route::post('orders/add/step1', 'OrderController@preOrder')->middleware('permission:orders.store');
    Route::post('factor/step/quick', 'OrderController@addOrderQuick')->middleware('permission:orders.quickstore');
    Route::get('orders/add/{id}', 'OrderController@serviceSchedule')->name('order.step2')->middleware('permission:orders.store');
    Route::post('orders/add/{id}', 'OrderController@store')->name('order.store')->middleware('permission:orders.store');



    Route::resource('person/{person_id}/timing', 'PersonTimingController')->except('edit','create')->middleware([
        'index' => 'permission:persons.timing.index',
        'store' => 'permission:persons.timing.store',
        'update' => 'permission:persons.timing.edit',
        'show' => 'permission:persons.timing.show',
        'destroy' => 'permission:persons.timing.destroy',
    ]);
    Route::resource('person/{person_id}/service', 'PersonServicesController')->except('edit','create')->middleware([
        'index' => 'permission:persons.service.index',
        'store' => 'permission:persons.service.store',
        'update' => 'permission:persons.service.edit',
        'show' => 'permission:persons.service.show',
        'destroy' => 'permission:persons.service.destroy',
    ]);
//Route::get('person/{person_id}/services', 'PersonServicesController@index');
//Route::post('person/{person_id}/services', 'PersonServicesController@update');

    Route::post('contact/notify', 'ContactNotifyController@send')->middleware('permission:contacts.notify');

//Route::post('addOrder', 'OrderController@addOrder');
//Route::post('editOrder', 'OrderController@editOrder');
//Route::post('payPayment', 'OrderController@payPayment');
//Route::post('printPayment', 'OrderController@printPayment');

    Route::get('/report', 'ReportController@report1')->middleware('permission:report');
    Route::get('/baseReport', 'ReportController@baseReport')->middleware('permission:baseReport');
    Route::get('/UserReport', 'ReportController@UserReport')->middleware('permission:UserReport');
    Route::get('/productReport', 'ReportController@productReport');
    Route::get('/workCalendar', 'workCalendarController@index')->middleware('permission:workCalendar');

    Route::namespace('Payment')->prefix('payment')->group(function () {
        Route::resource('/CompanyPayment', 'CompanyPaymentController')->except('edit','create')->middleware([
            'index' => 'permission:company.payment.index',
            'store' => 'permission:company.payment.store',
            'update' => 'permission:company.payment.edit',
            'show' => 'permission:company.payment.show',
            'destroy' => 'permission:company.payment.destroy',
        ]);
        Route::resource('/CustomerPayment', 'CustomerPaymentController')->except('edit','create')->middleware([
            'index' => 'permission:customer.payment.index',
            'store' => 'permission:customer.payment.store',
            'update' => 'permission:customer.payment.edit',
            'show' => 'permission:customer.payment.show',
            'destroy' => 'permission:customer.payment.destroy',
        ]);
        Route::resource('/BuyFactor', 'BuyFactorController')->except('edit','create')->middleware([
            'index' => 'permission:buyfactor.index',
            'store' => 'permission:buyfactor.store',
            'update' => 'permission:buyfactor.edit',
            'show' => 'permission:buyfactor.show',
            'destroy' => 'permission:buyfactor.destroy',
        ]);
        Route::resource('/Account', 'AccountController')->except('edit','create')->middleware([
            'index' => 'permission:account.index',
            'store' => 'permission:account.store',
            'update' => 'permission:account.edit',
            'show' => 'permission:account.show',
            'destroy' => 'permission:account.destroy',
        ]);
    });

    Route::resource('discount', 'DiscountController')->except('edit','create')->middleware([
        'index' => 'permission:discount.index',
        'store' => 'permission:discount.store',
        'update' => 'permission:discount.edit',
        'show' => 'permission:discount.show',
        'destroy' => 'permission:discount.destroy',
    ]);
    Route::post('discount/storeMany', 'DiscountController@storeMany')
        ->middleware('permission:discount.store');
    Route::get('discount/list','DiscountController@list');

    Route::post('discount/{discount}/notify','DiscountController@notify')->middleware('permission:discount.notify');

    Route::middleware(['jwt.auth'])->group(function (){

        Route::namespace('Reminder')->prefix('reminder')->group(function () {
            Route::get('clients','ReminderController@client');
            Route::get('user','ReminderController@user');
            Route::get('personnels','ReminderController@personnels');
            Route::get('contact','ReminderController@contact');
            Route::get('setRemember','ReminderController@contact');
            Route::post('setRemember','ReminderController@setRemember');
            Route::post('sendRemember','ReminderController@sendRemember');
            Route::get('deleteRemember/{id}','ReminderController@deleteRemember');
        });
    });
    //SpecialDateController
    Route::resource('contact/{contact_id}/specialDates', 'SpecialDateController')->except('edit','create')
        ->middleware([
        'index' => 'permission:specialdate.index',
        'store' => 'permission:specialdate.store',
        'update' => 'permission:specialdate.edit',
        'show' => 'permission:specialdate.show',
        'destroy' => 'permission:specialdate.destroy',
    ])
    ;

    Route::post('orders/discount', 'DiscountController@ApplyDiscountToOrder')->name('order.discount');
//    Route::post('orders/completed', 'OrderController@doneOrder')->name('order.Completed')->middleware('order.completed');
    Route::post('orders/completed', 'OrderController@doneOrder')->name('order.Completed');
//    Route::post('orders/cancel', 'OrderController@cancelOrder')->name('order.Cancel')->middleware('order.cancel');
    Route::post('orders/cancel', 'OrderController@cancelOrder')->name('order.Cancel');
//    Route::post('orders/payed', 'OrderController@paymentCompleted')->name('order.paymentCompleted')->middleware('permission:order.payed');
    Route::post('orders/payed', 'OrderController@paymentCompleted')->name('order.paymentCompleted');
//    Route::get('discounts/{discount}/notify', 'DiscountController@notify')->name('discount.notify')->middleware('discount.notify');
    Route::get('discounts/{discount}/notify', 'DiscountController@notify')->name('discount.notify');

    Route::resource('contact/groups', 'ContactGroupController')->except('edit','create')
        ->middleware([
            'index' => 'permission:contact.groups.index',
            'store' => 'permission:contact.groups.store',
            'update' => 'permission:contact.groups.edit',
            'show' => 'permission:contact.groups.show',
            'destroy' => 'permission:contact.groups.destroy',
        ]);
    Route::resource('contact/tags', 'CTagController')->except('edit','create')
        ->middleware([
            'index' => 'permission:contact.tags.index',
            'store' => 'permission:contact.tags.store',
            'update' => 'permission:contact.tags.edit',
            'show' => 'permission:contact.tags.show',
            'destroy' => 'permission:contact.tags.destroy',
        ]);
    Route::resource('vacations', 'VacationDateController')->except('edit','create')
        ->middleware([
            'index' => 'permission:vacation.index',
            'store' => 'permission:vacation.store',
            'update' => 'permission:vacation.edit',
            'show' => 'permission:vacation.show',
            'destroy' => 'permission:vacation.destroy',
        ]);
    Route::resource('scoregifts', 'ScoreGiftsController')->except('edit','create')
        ->middleware([
            'index' => 'permission:scoregifts.index',
            'store' => 'permission:scoregifts.store',
            'update' => 'permission:scoregifts.edit',
            'show' => 'permission:scoregifts.show',
            'destroy' => 'permission:scoregifts.destroy',
        ]);
    Route::resource('usergift', 'UserGiftController')->except('edit','create','update')
        ->middleware([
            'index' => 'permission:usergift.index',
            'store' => 'permission:usergift.store',
            'show' => 'permission:usergift.show',
            'destroy' => 'permission:usergift.destroy',
        ]);
//    Route::get('/productReport', 'ReportController@productReport')->middleware('Report.product');
//    Route::get('/incomeReport', 'ReportController@incomeReport')->middleware('Report.income');
    Route::get('/productReport', 'ReportController@productReport')->middleware('permission:report');
    Route::get('/incomeReport', 'ReportController@incomeReport')->middleware('permission:report');

    ///*** middleware must be change later ****///
    Route::get('/generalServiceReport', 'ReportController@generalServiceReport')->middleware('permission:report');
    Route::get('/generalProductReport', 'ReportController@generalProductReport')->middleware('permission:report');
    Route::get('/generalCostReport', 'ReportController@generalCostReport')->middleware('permission:report');
    Route::get('/generalOrderReport', 'ReportController@generalOrderReport')->middleware('permission:report');
    Route::get('/generalPaymentReport', 'ReportController@generalPaymentReport')->middleware('permission:report');
    Route::get('/generalPersonReport', 'ReportController@generalPersonReport')->middleware('permission:report');






    Route::get('/notifications','UserController@getCurrentUserUnreadedNotification');
    Route::post('/notifications','UserController@readNotification');

    Route::get('serviceCategorieslist', 'ServiceCategoryController@list');
    Route::get('serviceslist', 'ServiceController@list');
    Route::get('userslist', 'UserController@list');
    Route::get('scoregiftslist', 'ScoreGiftsController@list');
    Route::get('contact/tagslist', 'CTagController@list');
    Route::get('contact/groupslist', 'ContactGroupController@list');
    Route::get('productCategorieslist', 'ProductCategoryController@list');
    Route::get('productslist', 'ProductController@list');
//    Route::post('contact/sendReminder', 'ContactNotifyController@sendReminder')->middleware('Reminder.send');
    Route::post('contact/sendReminder', 'ContactNotifyController@sendReminder');
//    Route::get('contact/{number}/info', 'ContactController@FindByNumber')->middleware('contact.info');
    Route::get('contact/{number}/info', 'ContactController@FindByNumber');
//    Route::post('discount/{discount}/remind','DiscountController@remind')->middleware('discount.reminder');
    Route::post('discount/{discount}/remind','DiscountController@remind');

    Route::resource('contact/{contact}/reviews', 'ContactReviewController')->except('edit','create')->middleware([
        'index' => 'permission:contact.reviews.index',
        'store' => 'permission:contact.reviews.store',
        'show' => 'permission:contact.reviews.show',
        'update' => 'permission:contact.reviews.edit',
        'destroy' => 'permission:contact.reviews.destroy',
    ]);



    Route::resource('contactOrder/{contact}/{contactOrder}/reviews', 'ContactOrderReviewController')->except('edit','create')->middleware([
        'index' => 'permission:contact.reviews.index',
        'store' => 'permission:contact.reviews.store',
        'show' => 'permission:contact.reviews.show',
        'update' => 'permission:contact.reviews.edit',
        'destroy' => 'permission:contact.reviews.destroy',
    ]);






    Route::resource('productDiscount', 'ProductDiscountController')->except('edit','create')->middleware([
        'index' => 'permission:product.discount.index',
        'store' => 'permission:product.discount.store',
        'show' => 'permission:product.discount.show',
        'update' => 'permission:product.discount.edit',
        'destroy' => 'permission:product.discount.destroy',
    ]);
    Route::resource('serviceDiscount', 'ServiceDiscountController')->except('edit','create')->middleware([
        'index' => 'permission:service.discount.index',
        'store' => 'permission:service.discount.store',
        'show' => 'permission:service.discount.show',
        'update' => 'permission:service.discount.edit',
        'destroy' => 'permission:service.discount.destroy',
    ]);

    Route::resource('contact/{contact_id}/favorite', 'FavoriteController')->except('edit','create');
    Route::get('contact/{contact_id}/profile', 'ContactProfileController@index');
    Route::post('contact/{contact_id}/profile', 'ContactProfileController@update');



    Route::get('contact/orders/{contact_id}', 'ContactPaymentController@ordersSum');
    Route::get('contact/payments/{contact_id}', 'ContactPaymentController@paymentsSum');

    Route::get('order/payments/{order_id}', 'ContactPaymentController@orderPaymentsSum');


    Route::resource('contact/{contact_id}/ContactPayment', 'ContactPaymentController');





    Route::post('updateOrder/updateServiceItem/{order_id}', 'OrderController@updateServiceItem')->middleware('permission:orders.edit');
    Route::post('updateOrder/updateProductItem/{order_id}', 'OrderController@updateProductItem')->middleware('permission:orders.edit');

    Route::post('updateOrder/addServiceItem/{order_id}', 'OrderController@addServiceItem')->middleware('permission:orders.edit');
    Route::post('updateOrder/addProductItem/{order_id}', 'OrderController@addProductItem')->middleware('permission:orders.edit');

    Route::post('updateOrder/updateOrderFields/{order_id}', 'OrderController@updateOrderFields')->middleware('permission:orders.edit');
    Route::post('updateOrder/updateDiscount/{order_id}', 'OrderController@updateDiscount')->middleware('permission:orders.edit');




});

