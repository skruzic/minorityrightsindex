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
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('campaign', 'CampaignCrudController');
    CRUD::resource('section', 'SectionCrudController');

    Route::group(['prefix' => 'campaign/{campaign_id}'], function()
    {
        CRUD::resource('section', 'CampaignSectionCrudController');
        Route::get('download', 'CampaignSectionCrudController@download');

        Route::group(['prefix' => 'section/{section_id}'], function()
        {
            CRUD::resource('question', 'SectionQuestionCrudController');
        });
    });



    CRUD::resource('question', 'QuestionCrudController');
    CRUD::resource('optiongroup', 'OptionGroupCrudController');
}); // this should be the absolute last line of this file