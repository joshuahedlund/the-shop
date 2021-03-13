<?php

use Illuminate\Support\Facades\Route;

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

//Login
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('login', ['uses' => 'HomeController@showLogin', 'as' => 'login']);
    Route::post('login', ['uses' => 'HomeController@doLogin']);
    Route::get('logout', array('uses' => 'HomeController@doLogout'));
});

//Invenory
Route::group(['middleware' => ['auth'], 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('inventory', ['uses' => 'InventoryController@index']);
    Route::post('api/inventory', ['uses' => 'InventoryController@getInventory']);
});

Route::get('/', function () {
    return view('home');
});
