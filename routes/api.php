<?php

use App\Http\Controllers\Api\CampaignsController;
use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

Route::apiResource('campaign', CampaignsController::class)->only(['index', 'store', 'show']);
Route::get('campaign/token/{token}', [CampaignsController::class, 'findByToken']);
Route::get('campaign/slug/{slug}', [CampaignsController::class, 'findBySlug']);
Route::post('campaign/invite/update', [CampaignsController::class, 'updateStatus']);

Route::get('menu', MenuController::class);
