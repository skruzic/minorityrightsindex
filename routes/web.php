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

Auth::routes();

//Route::get('/admin', 'HomeController@index')->name('home');

/*Route::resources([
    'admin/campaign' => 'Admin\CampaignController',
    'admin/question' => 'Admin\QuestionsController',
]);*/

Route::prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resources([
        'campaign'    => 'Admin\CampaignController',
        //'question'    => 'Admin\QuestionsController',
        'optiongroup' => 'Admin\OptionGroupsController',
        //'section'     => 'Admin\SectionsController',
    ]);

    Route::resource('campaign.section', 'Admin\SectionsController', ['except' => 'index']);
    Route::resource('campaign.section.question', 'Admin\QuestionsController');
    //Route::resource('campaign.section.questiongroup', 'Admin\QuestionGroupsController');
    //Route::get('section/{campaign_id}', 'Admin\SectionsController@show')->name('section.show');
});

//Route::get('campaign/{id}', 'CampaignController@fill');
//Route::post('campaign', 'CampaignController@save')->name('campaign.save');
Route::get('/{any}', 'SinglePageController')->where('any', '.*');
