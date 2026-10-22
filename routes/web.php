<?php

use App\Http\Controllers\SinglePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', SinglePageController::class);

// The admin panel and the API are registered separately. This catch-all
// serves the public survey app for every other path.
Route::get('/{any}', SinglePageController::class)
    ->where('any', '^(?!api|up|admin).*$');
