<?php

use App\Http\Controllers\Api\CampaignsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('campaign', CampaignsController::class)->only(['index', 'store', 'show']);
Route::get('campaign/token/{token}', [CampaignsController::class, 'findByToken']);
Route::get('campaign/slug/{slug}', [CampaignsController::class, 'findBySlug']);
Route::post('campaign/invite/update', [CampaignsController::class, 'updateStatus']);
