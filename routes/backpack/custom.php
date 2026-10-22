<?php

use App\Http\Controllers\Admin\CampaignCrudController;
use App\Http\Controllers\Admin\QuestionCrudController;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('user', 'UserCrudController');
    Route::crud('campaign', 'CampaignCrudController');
    Route::get('campaign/{id}/lock', [CampaignCrudController::class, 'lock']);
    Route::get('campaign/{id}/clone', [CampaignCrudController::class, 'clone']);

    Route::group(['prefix' => 'campaign/{campaign_id}'], function () {
        Route::crud('invite', 'InviteCrudController');
        Route::get('download', [QuestionCrudController::class, 'download']);
        Route::crud('question', 'QuestionCrudController');
    });

    Route::crud('optiongroup', 'OptionGroupCrudController');
}); // this should be the absolute last line of this file
