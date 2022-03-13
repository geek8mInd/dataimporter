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

Route::get('/customers', 'APIController@getAllCustomers')->name('/customers');
Route::get('/customers/{customer}', 'APIController@getByCustomerID')->name(/customers/{customer});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
