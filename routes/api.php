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

/*Route::group(['middleware' => 'auth:api'], function() {
    Route::resource('campaign', '')
});*/

Route::middleware('auth:api')->prefix('admin')->group(function() {
    Route::resource('campaign', 'API\CampaignsController');

});

// Kampanje
Route::apiResource('campaign', 'API\CampaignsController');
Route::get('menu', 'API\MenuController');