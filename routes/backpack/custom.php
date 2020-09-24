<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('campaign', 'CampaignCrudController');
    //CRUD::resource('section', 'SectionCrudController');

    Route::group(['prefix' => 'campaign/{campaign_id}'], function()
    {
        Route::crud('section', 'CampaignSectionCrudController');
        Route::get('download', 'CampaignSectionCrudController@download');

        Route::group(['prefix' => 'section/{section_id}'], function()
        {
            Route::crud('question', 'SectionQuestionCrudController');
        });
    });



    //CRUD::resource('question', 'QuestionCrudController');
    Route::crud('optiongroup', 'OptionGroupCrudController');
}); // this should be the absolute last line of this file
