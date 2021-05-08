<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//User Auth Routes
Route::post('/user/register','Api\UserAuthController@register')->name('api.register');
Route::post('/user/login','Api\UserAuthController@login')->name('api.login');

Route::middleware('auth:api-user')->group(function() {
    //Banks Routes
    Route::get('/banks','Api\BanksController@index')->name('api.bank.index');
    Route::post('/banks','Api\BanksController@store')->name('api.bank.store');
    Route::put('/banks/{id}','Api\BanksController@update')->name('api.bank.update')->where('id','[0-9]+');
    Route::delete('banks/{id}','Api\BanksController@destroy')->name('api.bank.delete')->where('id','[0-9]+');
    Route::get('/banks/get_transaction_sum/{id}','Api\BanksController@getTransactionSum')->name('api.bank.getTransactionTotal')->where('id','[0-9]+');

    //transactions Routes
    Route::get('/transactions','Api\TransactionsController@index')->name('api.transaction.index');
    Route::post('/transactions','Api\TransactionsController@store')->name('api.transaction.store');
    Route::delete('/transactions/{id}','Api\TransactionsController@destroy')->name('api.transaction.delete')->where('id','[0-9]+');
    Route::put('/transactions/{id}','Api\TransactionsController@update')->name('api.transaction.update')->where('id','[0-9]+');

});