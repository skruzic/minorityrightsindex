<?php

use App\Http\Controllers\Admin\CampaignCrudController;
use App\Http\Controllers\Api\AnswersController;
use App\Http\Controllers\Api\CampaignsController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\ResponseController;
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

/*Route::middleware('auth:api')->prefix('admin')->group(function() {
    Route::resource('campaign', 'API\CampaignsController');
});*/

// Kampanje
Route::apiResource('campaign', CampaignsController::class)->only(['index', 'store', 'show']);
Route::get('campaign/token/{token}', [CampaignsController::class, 'findByToken']);
Route::get('campaign/slug/{slug}', [CampaignsController::class, 'findBySlug']);

Route::get('menu', MenuController::class);
Route::get('page/{slug}', PagesController::class);
