<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'nexus'], function () {

    Route::get('login',['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login',['uses' => 'Auth\LoginController@login']);

    Route::get('register',['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register',['uses' => 'Auth\RegisterController@register']);

    Route::post('logout',['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
});

Route::group(['prefix' => 'nexus', 'middleware' => 'isAdminUser'], function () {

    Route::get('/', 'DashboardController@index');
    Route::get('/client/{id}', 'DashboardController@client');

    Route::get('/admins', 'AdminController@index');
    Route::post('/admins/add', 'AdminController@store');

    Route::get('/bmic', 'BmicController@index');
    Route::post('/bmic', 'BmicController@store');
    Route::get('/bmic/price', 'BmicController@price');
    Route::post('/bmic/update/{id}', 'BmicController@update');
    Route::get('/bmic/delete/{id}', 'BmicController@delete');
    Route::post('/bmic/coefficient', 'BmicController@store_coefficient');

    Route::get('/discount', 'DiscountController@index');
    Route::post('/discount/add', 'DiscountController@store');
    Route::post('/discount/update/{id}', 'DiscountController@update');

    Route::get('/map_associate', 'MapAssociateController@index');
    Route::get('/map_manager', 'MapManagerController@index');

    Route::get('/product_pricing', 'ProductPricingController@index');
    Route::post('/product_pricing', 'ProductPricingController@update');

    Route::get('/ss', 'SalesSupportController@index');
    Route::get('/tax', 'TaxController@index');
    Route::post('/tax', 'TaxController@update');

    Route::get('/billing', 'BillingController@index');
    Route::get('/invoice/{id}', 'BillingController@invoice');
    Route::get('/invoice/refund/{id}', 'BillingController@refund');
    Route::get('/invoice/cancel/{id}', 'BillingController@cancel');

    Route::get('/tickets', 'TicketController@index');
    Route::get('/tickets/{ticket}', 'TicketController@show');
    Route::put('/tickets/{ticket}', 'TicketController@update');
    Route::put('/tickets/status/{ticket}', 'TicketController@update_status');
    Route::put('/tickets/message/{ticket}', 'TicketController@add_massage');

    Route::get('/agents', 'AgentController@index');
    Route::get('/agents/{agent}', 'AgentController@show');
    Route::put('/agents/{agent}', 'AgentController@update');
    Route::get('/agents/delete/{id}', 'AgentController@delete');
    Route::post('/agents', 'AgentController@store');

    Route::get('/monthly-plans', 'MonthlyPlanController@index');
    Route::post('/monthly-plans', 'MonthlyPlanController@update');

    Route::get('/monthly-plans/delete/{id}', 'MonthlyPlanController@deleteMothlyPlan');
    Route::PUT('/monthly-plans/sorted', 'MonthlyPlanController@sortedMothlyPlan');

    Route::get('/pricing-strategy', 'PricingStrategyController@index');
    Route::post('/pricing-strategy', 'PricingStrategyController@update');

    Route::get('/addon-packages/delete/{id}', 'MonthlyPlanController@deleteAddonPackage');
    Route::PUT('/addon-packages/sorted', 'MonthlyPlanController@sortedAddonPackage');
});
