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

//laravel welcome page route
Route::get('/welcome', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/ocr', 'OcrController@ocr');
Route::get('/', 'OcrController@landing');

Route::group(['middleware' => 'auth', 'middlewareGroups' => 'web'], function(){

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/dashboard', function(){
        return redirect()->route('home');
    });

    Route::resource('users', 'UsersController');
    Route::get('/show_by_id/users/{id}', 'UsersController@show_by_id')->name('show_by_id');
    Route::get('/admins', 'UsersController@admin_index')->name('admin_index');
    Route::get('/admin/add_admin/create', 'UsersController@add_admin')->name('add_admin');
    Route::post('/users/add_admin/store', 'UsersController@admin_store')->name('admin.store');
    Route::get('/trash/users', 'UsersController@trashed_users')->name('trashed_users');
    Route::get('/trash/admins', 'UsersController@trashed_admins')->name('trashed_admins');
    Route::post('/trash/users/{slug}/restore', 'UsersController@restore')->name('users.restore');
    Route::delete('/trash/users/{slug}/p_destroy', 'UsersController@p_destroy')->name('users.p_destroy');

    Route::resource('matches', 'MatchController');
    Route::get('/matches-sort/winnings', 'MatchController@winnings')->name('matches.winnings');
    Route::get('/matches-sort/upcoming', 'MatchController@upcoming')->name('matches.upcoming');
    Route::get('/matches-sort/recent/{days?}', 'MatchController@recent')->name('matches.recent');
    Route::get('/matches-sort/pending', 'MatchController@pending')->name('matches.pending');
    Route::post('/matches-results/update/{match}', 'MatchController@match_results')->name('match.results');

    Route::Resource('plans', 'PlanController');

    Route::get('/subscriptions-all', 'SubscriptionController@all')->name('subscriptions.all');
    Route::get('/subscriptions-active-subscriptions', 'SubscriptionController@active_subscriptions')->name('subscriptions.active');
    Route::get('/subscriptions/active-subscribers', 'SubscriptionController@active_subscribers')->name('subscribers.active');
    Route::any('/subscriptions/search-subscriptions', 'SubscriptionController@search')->name('subscriptions.search');

    Route::get('/mpesa/transactions', 'MpesaController@transactions')->name('mpesa.transactions');
    Route::get('/mpesa/completed', 'MpesaController@completed')->name('mpesa.completed');
    Route::get('/mpesa/cancelled', 'MpesaController@cancelled')->name('mpesa.cancelled');
    Route::get('/Mpesa/show/{mpesa}', 'MpesaController@show_transaction')->name('mpesa.show');
    Route::any('/mpesa/search-transactions', 'MpesaController@search')->name('mpesa.search');
    Route::get('/mpesa/query-request', 'MpesaController@query_request');
    Route::get('/mpesa/handle-result', 'MpesaController@handle_result')->name('handle_result');
    Route::get('/mpesa/payment-result', 'MpesaController@payment_result');

    Route::get('/paypal/completed', 'PaypalController@completed')->name('paypal.completed');
    Route::any('/paypal/search-transactions', 'PaypalController@search')->name('paypal.search');
    Route::get('/Paypal/show/{paypal}', 'PaypalController@show_transaction')->name('paypal.show');
});

