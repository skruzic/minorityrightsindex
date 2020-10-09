<?php

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

/*Route::get('/', function () {
    //return new \App\Http\Resources\CampaignResource::collection(App\Models\Campaign::all());
    return view('welcome');
});*/

//Auth::routes();

//Route::get('/admin', 'HomeController@index')->name('home');

/*Route::resources([
    'admin/campaign' => 'Admin\CampaignController',
    'admin/question' => 'Admin\QuestionsController',
]);*/

/*Route::prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('user', 'Admin\UsersController');

    Route::resources([
        'campaign'    => 'Admin\CampaignController',
        'optiongroup' => 'Admin\OptionGroupsController',
    ]);

    Route::resource('campaign.section', 'Admin\SectionsController', ['except' => 'index']);
    Route::resource('campaign.section.question', 'Admin\QuestionsController');
});*/

use App\Http\Controllers\SinglePageController;

Route::get('/{any}', SinglePageController::class)->where('any', '^(?!api).*$');
