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
Route::post('/user/resgiter','Api\UserAuthController@register')->name('api.register');
Route::post('/user/login','Api\UserAuthController@login')->name('api.login');

Route::middleware('auth:api-user')->group(function() {
    //Banks Routes
    Route::get('/banks','Api\BanksController@index');
    Route::post('/banks','Api\BanksController@store');
    Route::put('/banks/{id}','Api\BanksController@update')->where('id','[0-9]+');
    Route::delete('banks/{id}','Api\BanksController@destroy')->where('id','[0-9]+');
    Route::get('/banks/get_transaction_sum/{id}','Api\BanksController@getTransactionSum')->where('id','[0-9]+');

    //transactions Routes
    Route::get('/transactions','Api\TransactionsController@index');
    Route::post('/transactions','Api\TransactionsController@store');
    Route::delete('/transactions/{id}','Api\TransactionsController@destroy')->where('id','[0-9]+');
    Route::put('/transactions/{id}','Api\TransactionsController@update')->where('id','[0-9]+');

});