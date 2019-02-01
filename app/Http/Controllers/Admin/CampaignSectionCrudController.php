<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SectionRequest as StoreRequest;
use App\Http\Requests\SectionRequest as UpdateRequest;
use App\Helpers\AnswerExporter;

/**
 * Class campaignSectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CampaignSectionCrudController extends SectionCrudController
{
    public function setup()
    {
        parent::setup();

        $campaign_id = \Route::current()->parameter('campaign_id');

        $this->crud->setRoute('admin/campaign/'.$campaign_id.'/section');

        $this->crud->addClause('where', 'campaign_id', $campaign_id);

        $this->crud->removeColumn('campaign');

        $this->crud->setHeading('Sections in Campaign #' . $campaign_id, 'index');

        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('title', 2);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }

    public function download()
    {
        $answers =  (new AnswerExporter($this->crud->getCurrentEntry()->id))->export();

        //return response($answers)->download();

        //return response()->download((new AnswerExporter($this->crud->getCurrentEntry()->id))->export());

        /*return response()->streamDownload(function() {
            $answers =  (new AnswerExporter($this->crud->getCurrentEntry()->id))->export();
            echo $answers;
        });*/
    }
}
