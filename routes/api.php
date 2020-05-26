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
    return $request->user();
});

Route::get('/user/items/{user_id}/{plan_id}/{category_id}', 'UserPlansController@getItems')->name('get.items');
Route::post('/item', 'UserPlansController@storeItem')->name('get.items');

Route::get('/users/{id}', 'BudgetUsersController@getUsers')->name('get.users');


