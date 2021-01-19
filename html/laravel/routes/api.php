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

Route::post('v1/auth/login', 'Api\\AuthController@login');

Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'Api',
        'middleware' => ['apiJwt']
    ], function () {
        Route::post('auth/me', 'AuthController@me');
        Route::post('auth/refresh', 'AuthController@refresh');
        Route::post('auth/logout', 'AuthController@logout');
        Route::get('people', 'PeopleController@index');
        Route::get('people/{id}', 'PeopleController@findById');
        Route::get('items', 'ItemsController@index');
        Route::get('items/{id}', 'ItemsController@findById');
        Route::get('shiptos', 'ShipTosController@index');
        Route::get('shiptos/{id}', 'ShipTosController@findById');
        Route::get('shiporders', 'ShipOrdersController@index');
        Route::get('shiporders/{id}', 'ShipOrdersController@findById');
        Route::get('shiporders/{id}/shipto', 'ShipOrdersController@findShiptoByOrderId');
        Route::get('shiporders/{id}/items', 'ShipOrdersController@findItemsByOrderId');

});
